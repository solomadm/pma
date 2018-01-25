<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers\Admin;

use App\ConferenceAsset;
use App\Content;
use App\Http\Controllers\Controller;
use App\Http\Requests\Content\ConferenceGlobalContentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class ContentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function global()
    {
        $content = Content::GetContentVue('global', Auth::user()->conference);

        return view(
            'admin.content.global',
            [
                'content' => $content,
            ]
        );
    }


    public function globalPost(ConferenceGlobalContentRequest $r)
    {

        $content = [
            'meta_title'              => $r->input('meta_title'),
            'meta_description'        => $r->input('meta_description'),
            'primary_color_1'         => $r->input('primary_color_1'),
            'primary_color_2'         => $r->input('primary_color_2'),
            'primary_text_1'          => $r->input('primary_text_1'),
            'primary_text_2'          => $r->input('primary_text_2'),
            'forum_title'             => $r->input('forum_title'),
            'forum_date'              => $r->input('forum_date'),
            'forum_venue'             => $r->input('forum_venue'),
            'event_logo'              => $r->input('event_logo'),
            'header_banner'           => $r->input('header_banner'),
            'header_image'            => $r->input('header_image'),
            'footer_copyright_text'   => $r->input('footer_copyright_text'),
            'footer_background_image' => $r->input('footer_background_image'),
            'footer_left_text'        => $r->input('footer_left_text'),
            'footer_left_link'        => $r->input('footer_left_link'),
            'footer_left_image'       => $r->input('footer_left_image'),
            'footer_right_text'       => $r->input('footer_right_text'),
            'footer_right_link'       => $r->input('footer_right_link'),
            'footer_right_image'      => $r->input('footer_right_image'),
            'footer_social_text'      => $r->input('footer_social_text'),
            'footer_social_link_fb'   => $r->input('footer_social_link_fb'),
            'footer_social_link_tw'   => $r->input('footer_social_link_tw'),
            'footer_social_link_ln'   => $r->input('footer_social_link_ln'),
            'footer_social_link_yt'   => $r->input('footer_social_link_yt'),
        ];

        $save = Content::SaveContent('global', $content);

        return response()->json(
            [
                'success' => true,
                'updated' => $save,
            ]
        );
    }


    public function mediaManager()
    {
        return view('admin.content.media-manager');
    }


    public function mediaManagerUpload(Request $r)
    {
        $fileName = time().rand(1, 10).'.'.$r->file->getClientOriginalExtension();

        list($width, $height) = getimagesize($r->file);
        $type = $r->input('type');

        $conference = Auth::user()->conference;

        $asset = new ConferenceAsset;

        $asset->filename = $r->file->getClientOriginalName();
        $asset->size = $r->file->getClientSize();
        $asset->width = $width;
        $asset->height = $height;
        $asset->path = '/storage/cms/'.$conference->url_slug.'/'.$type.'/'.$fileName;
        $asset->type = $type;
        $asset->conference_id = $conference->id;

        $asset->save();

        $r->file->move(storage_path('app/public/cms/'.$conference->url_slug.'/'.$asset->type), $fileName);

        if ($type == 'file') {
            $pdf = new \Spatie\PdfToImage\Pdf(storage_path('app/public/cms/'.$conference->url_slug.'/'.$type.'/'.$fileName));
            $pdf->saveImage(storage_path('app/public/cms/'.$conference->url_slug.'/'.$type.'/'.$fileName."_THUMB.png"));
        }

        return response()->json(
            [
                "uploaded" => true,
                "asset"    => $asset,
            ]
        );
    }


    public function mediaManagerSaveAlt(Request $r)
    {

        $asset = ConferenceAsset::find($r->input('id'));

        $asset->alt_text = $r->input('alt_text');
        $asset->save();

        //Make the user think there's some really complex stuff going on
        sleep(1);

        return response()->json(
            [
                'success' => true,
            ]
        );

    }
}
