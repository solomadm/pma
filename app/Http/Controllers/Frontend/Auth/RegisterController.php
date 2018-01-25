<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\ConferenceAsset;
use App\Content;
use App\Delegate;
use App\Helpers\AssetSave;
use App\Helpers\General;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Request;
use Validator;
use App\Conference;

/**
 * Class RegisterController
 * @package %%NAMESPACE%%\Http\Controllers\Auth
 */
class RegisterController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;
    use AssetSave;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

    public $assetType = 'delegate';

	private $conference;


	/**
	 * Create a new controller instance.
	 *
	 * @var Request $request
	 *
	 * @return void
	 */
	public function __construct( Request $request ) {
		$this->redirectTo = General::conferenceRoute( 'frontend.index' );
		$this->middleware( 'delegate.guest' );

		$currentConference = $request->segment( 1 );
		$this->conference  = Conference::where( 'url_slug', $currentConference )->first();
	}


	/**
	 * Show the application registration form.
	 *
	 * @param \App\Conference $conference
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistrationForm( Conference $conference ) {

//	    $data = [
//		    'global'   => $conference->content->where('page', 'global')->keyBy('identifier'),
//		    'register' => $conference->content->where('page', 'register')->keyBy('identifier'),
//	    ];

		$data = [
			'global'   => Content::GetContent( 'global', $conference ),
			'register' => Content::GetContent( 'register', $conference ),
		];

		return view(
			'frontend.themes.' . $conference->frontend_theme . '.register',
			$data
		);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array $data
	 *
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator( array $data ) {
		return Validator::make(
			$data,
			[
				'email'        => 'required|email|max:255',
				'uic'          => 'required|uic_user:' . $data['email'],
				'password'     => 'required|min:6|confirmed',
				'first_name'   => 'required|max:255',
				'last_name'    => 'required|max:255',
				'title'        => 'required|max:255',
				'age_group'    => 'required|max:255',
				'nationality'  => 'required|max:255',
				'address1'     => 'required|max:255',
				'postcode'     => 'required|max:255',
				'country'      => 'required|max:255',
				'job_title'    => 'required|max:255',
				'organisation' => 'required|max:255',
				'phone_mobile' => 'required|max:255',
				'industry'     => 'required|max:255',
				'photo'        => 'nullable|image64:jpeg,jpg,png',
			]
		);
	}


	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array $data
	 *
	 * @return Delegate
	 */
	protected function create( array $data ) {
        $data = array_filter(
            $data,
            function ($el) {
                return !is_null($el);
            }
        );
		$delegate = new Delegate();
		$photo = 0;
        if (isset($data['photo']) && is_array($data['photo'])) {
            $photo = $this->savePhoto($data['photo']);
		}

		$fillable = $delegate->getFillableColumns();

		foreach ( $data as $key => $val ) {
			if ( ! in_array( $key, $fillable ) ) {
				unset( $data[ $key ] );
			}
		}
		$delegate = Delegate::where('uic', $data['uic'])->where('email', $data['email'])->first();
		$data['photo'] = $photo;
		$delegate->fill( $data );
		$delegate->email         = $data['email'];
		$delegate->password      = Hash::make( $data['password'] );
		$delegate->conference_id = $this->conference->id;
        $delegate->enabled = true;
		$delegate->save();

		return $delegate;
	}


	/**
	 * Store photo, return asset id
	 *
	 * @param $photo
	 *
	 * @return bool|mixed
	 */
    private function savePhoto($photo)
    {
        return $this->saveFile($photo, $this->assetType);
	}


	/**
	 * The user has been registered.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  mixed $user
	 *
	 * @return mixed
	 */
	protected function registered( Request $request, $user ) {
		return response()->json( [
			'success'   => true,
			'delegate' => $user
		] );
	}


	/**
	 * Get the guard to be used during registration.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard() {
		return Auth::guard( 'delegate' );
	}
}
