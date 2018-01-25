<?php

namespace App\Http\Controllers\Frontend;

use App\Conference;
use App\Content;
use App\Country;
use App\Helpers\AssetSave;
use App\Http\Controllers\Controller;
use App\Http\Requests\PutMediaRequest;
use App\Mail\MediaRegisterNotification;
use App\Media;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class MediaController extends Controller
{

    use AssetSave;

    private $conference;

    public $assetType = 'media';


    /**
     * Create a new controller instance.
     *
     * @var Request $request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $currentConference = $request->segment(1);
        $this->conference = Conference::where('url_slug', $currentConference)->first();
    }


    public function register(Conference $conference)
    {

        return view(
            'frontend.themes.'.$conference->frontend_theme.'.media',
            [
                'global'    => Content::GetContent('global', $conference),
                'media'     => Content::GetContent('media', $conference),
                'countries' => Country::select(['name as value', 'full_name as text'])->get()->toArray(),
            ]
        );
    }


    public function store(PutMediaRequest $request)
    {
        $data = $request->all();
        $data = array_filter($data);
        $data = $this->savePhotos($data);
        try {
            $media = new Media($data);
            $media->save();
            \Mail::to(env('MAIL_FROM_ADDRESS'))->send(new MediaRegisterNotification($media));
        } catch (\Exception $e) {
            \Log::info('MediaController@store: ', [$e]);

            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }


    protected function savePhotos($data)
    {
        $fileFields = [
            'photo',
            'article1',
            'article2',
            'article3',
        ];

        foreach ($fileFields as $file_field) {
            if (!empty($data[$file_field]) && is_array($data[$file_field])) {
                $data[$file_field] = $this->saveFile($data[$file_field], $this->assetType);
            } else {
                $data[$file_field] = 0;
            }
        }

        return $data;
    }
}
