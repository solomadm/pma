<?php namespace App\Http\Controllers\Admin;

use App\Conference;
use App\Http\Requests\Delegate\PutDelegateRequest;
use App\Http\Requests\Delegate\UploadDelegateCsvRequest;
use App\User;
use Auth;
use Excel;
use Hash;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Collections\CellCollection;
use Maatwebsite\Excel\Collections\RowCollection;
use App\Http\Requests\EmptyRequest;
use App\Http\Requests\Delegate\PatchDelegateRequest;
use App\Delegate;
use Validator;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class DelegateController extends BaseController {
	// TODO: chunk + refactor front-end
	public function getAll() {
		$columns = [
			'id',
			'uic',
			'first_name',
			'last_name',
			'email',
			'country',
			'confirmed',
			'enabled'
		];
		$values  = Delegate::all( $columns );

		return view( 'admin.delegate.index', [ 'values' => $values ] );
	}

	/**
	 * Retrieve single delegate
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function get( $id ) {
		$delegate = Delegate::find( $id );

		if ( ! $delegate ) {
			abort( 404 );
		}

		return response()->json( $delegate );
	}

	/**
	 * Update delegate
	 * Validate unique UIC
	 *
	 * @param $id
	 * @param PatchDelegateRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function patch( $id, PatchDelegateRequest $request ) {
		$conferenceId = $this->getActiveConferenceId();
		$delegate     = Delegate::find( $id );

		if ( ! $delegate ) {
			abort( 404 );
		}

		$delegateData = $this->filterDelegate( $request->all() );

		if ( isset( $delegateData['uic'] ) ) {
			if ( Delegate::where( 'id', '!=', $id )
			             ->where( 'uic', $delegateData['uic'] )
			             ->where( 'conference_id', $conferenceId )
			             ->first() ) {
				return response()->json( [
					'success' => false,
					'uic'     => 'The uic has already been taken.'
				], 422 );
			}
		}

		$fillable = $delegate->getFillableColumns();

		foreach ( $fillable as $f ) {
			if ( ! isset( $delegateData[ $f ] ) ) {
				continue;
			}
			if ( $f === "password" ) {
				if ( ! empty( $request->input( $f ) ) ) {
					$delegate->$f = Hash::make( $request->input( $f ) );
				}
			} else {
				$delegate->$f = $request->input( $f );
			}
		}

		return response()->json( [
			'success'  => $delegate->save(),
			'delegate' => $delegate
		] );
	}

	/**
	 * Create new delegate
	 *
	 * @param PutDelegateRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function put( PutDelegateRequest $request ) {
		$conferenceId = $this->getActiveConferenceId();
		$delegate     = new Delegate();

		$delegateData = $this->filterDelegate( $request->all(), true );

		$delegate->fill( $delegateData );
		$delegate->email         = $delegateData['email'];
		$delegate->uic           = isset( $delegateData['uic'] ) ? $delegateData['uic'] : $this->getUniqueUIC( $conferenceId );
		$delegate->password      = Hash::make( $request->password );
		$delegate->conference_id = $conferenceId;

		return response()->json( [
			'success'  => $delegate->save(),
			'delegate' => $delegate
		] );
	}

	/**
	 * Delete delegates by id list
	 *
	 * @param EmptyRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function deleteIds( EmptyRequest $request ) {
		$success = Delegate::whereIn( 'id', $request->input( 'ids' ) )->delete();

		return response()->json( [
			'success' => $success
		] );
	}

	/**
	 * Delete delegate by id
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete( $id ) {
		/** @var Delegate $delegate */
		$delegate = Delegate::find( $id );

		if ( ! $delegate ) {
			abort( 404 );
		}

		$delegate->delete();

		return redirect()->back();
	}

	public function getBlankCsv() {
		/** @var User $self */
		$self = Auth::user();
		/** @var Conference $conference */
		$conference = $self->conference;

		if ( ! $conference ) {
			$conference = $self->conference()->first();
		}

		$name    = $conference->name ? $conference->name . " - delegates" : 'Delegates';
		$columns = ( new Delegate() )->getFillableColumns();

		Excel::create( $name, function ( $excel ) use ( $name, $columns ) {
			$excel->sheet( $name, function ( $sheet ) use ( $columns ) {
				$sheet->fromArray( $columns, null, 'A1', true );
			} );
		} )->export( 'xls' );
	}

	/**
	 * Parse CSV with delegates
	 *
	 * @param UploadDelegateCsvRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function uploadCsv( UploadDelegateCsvRequest $request ) {
		$file         = $request->file( 'file' );
		$conferenceId = $this->getActiveConferenceId();

		$rows = $this->parseFileExcel( $file );

		/** @var MessageBag $errorsBag */
		$errorsBag = $this->validateCsv( $rows, $conferenceId );

		if ( count( $errorsBag ) > 0 ) {
			$errorsArray = $errorsBag->toArray();
			$errors      = [];

			foreach ( $errorsArray as $subArr ) {
				foreach ( $subArr as $v ) {
					$errors[] = $v;
				}
			}

			sort( $errors );

			return redirect()->route( 'admin.delegate.upload-csv-page' )->with( 'errors', $errors );
		}

		try {
			$this->saveRows( $rows, $conferenceId );
		} catch ( QueryException $e ) {
			\Log::info( 'DelegateController::uploadCsv::QueryException', [ $e->getMessage() ] );

			return redirect()->route( 'admin.delegate.upload-csv-page' )->with( 'errors', [ 'fatal' => 'Error during database insert' ] );
		} catch ( \Exception $e ) {
			\Log::info( 'DelegateController::uploadCsv::Exception', [ $e->getMessage() ] );

			return redirect()->route( 'admin.delegate.upload-csv-page' )->with( 'errors', [ 'fatal' => 'Something went wrong' ] );
		}


		return redirect()->route( 'admin.delegate.get' );
	}

	private function validateCsv( $rows, $conferenceId ) {
		$errors = new MessageBag();

		try {
			$validator = Validator::make( $rows, [
				'*.email'      => [
					'required',
					'email',
					Rule::unique( 'delegates' )->where( function ( $query ) use ( $conferenceId ) {
						$query->where( 'conference_id', $conferenceId );
					} )
				],
//				'*.password'   => 'required',
//				'*.first_name' => 'required',
//				'*.last_name'  => 'required',
//				'*.country'    => 'required',
				'*.age_group'  => 'nullable|numeric',
				'*.uic'        => [
					Rule::unique( 'delegates' )->where( function ( $query ) use ( $conferenceId ) {
						$query->where( 'conference_id', $conferenceId );
					} )
				],
			], [
				'required' => 'The :attribute field is required.',
			] );

			if ( $validator->fails() ) {
				$errors = $validator->messages();
			} else {
				$uicCount = 0;
				$uicList  = [];
				foreach ( $rows as $key => $row ) {
					if ( ! isset( $row['uic'] ) || empty( $row['uic'] ) ) {
						continue;
					}
					$uicCount ++;
					if ( in_array( $row['uic'], $uicList, true ) ) {
						continue;
					}
					$uicList[] = $row['uic'];
				}
				if ( $uicCount != count( $uicList ) ) {
					$errors->add( 'uic_duplicate', 'Duplicate UIC in file' );
				}
			}
		} catch ( \Exception $e ) {
			$errors->add( 'Fatal error', $e->getMessage() );
		}

		return $errors;
	}

	public function uploadCsvPage() {
		return view( 'admin.delegate.upload-page' );
	}

	/**
	 * @param UploadedFile $file
	 *
	 * @return array
	 */
	private function parseFileExcel( $file ) {
		$path = $file->getRealPath();


		$excel = Excel::load( $path )->get();
		/** @var RowCollection $rows */
		$rows = $excel->map( function ( $line ) {
			/** @var CellCollection $line */
			return array_filter( $line->toArray() );
		} );

		$rows = $rows->toArray();

		/** @var array $rows */
		if ( isset( $rows[''] ) ) {
			unset( $rows[''] );
		}

		if ( count( $rows ) == 2 && empty( $rows[1] ) ) {
			return array_shift( $rows );
		}

		return $rows;
	}

	private function saveRows( $rows, $conferenceId ) {
		$fillable = ( new Delegate() )->getFillableColumns();

		foreach ( $rows as $row ) {
			$delegate = new Delegate();

			$row = $this->filterDelegate($row, true);

			foreach ( $fillable as $f ) {
				if ( ! isset( $row[ $f ] ) ) {
					continue;
				}
				$delegate->$f = $row[ $f ];
			}

			$delegate->uic           = ! empty( $row['uic'] ) ? $row['uic'] : $this->getUniqueUIC( $conferenceId );
			$delegate->email         = $row['email'];
			$delegate->password      = Hash::make( $row['password'] );
			$delegate->conference_id = $conferenceId;


			$delegate->save();
		}
	}

	private function getUniqueUIC( $conferenceId ) {
		$random_string = $this->generateRandomString() . rand( 1000, 9999 );
		if ( Delegate::where( 'uic', $random_string )->where( 'conference_id', $conferenceId )->first() ) {
			\Log::info( 'DelegateController::getUniqueUIC::MiracleDuplicatedRandomString', [ $random_string ] );
			$random_string = $this->getUniqueUIC( $conferenceId );
		}

		return $random_string;
	}

	private function generateRandomString( $length = 3 ) {
		$characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen( $characters );
		$randomString     = '';
		for ( $i = 0; $i < $length; $i ++ ) {
			$randomString .= $characters[ rand( 0, $charactersLength - 1 ) ];
		}

		return $randomString;
	}

	private function filterDelegate($data, $fillRequired = false) {
		if($fillRequired) {
			$required = [
				'first_name' => 'Empty',
				'last_name' => 'Empty',
				'country' => 'Not Selected',
				'password' => 'password'
			];
			foreach ($required as $field => $value) {
				if(!isset($data[$field]) || empty($data[$field])) {
					$data[$field] = $value;
				}
			}
		}
        $data = array_filter(
            $data,
            function ($el) {
                return !is_null($el);
            }
        );
		return $data;
	}
}
