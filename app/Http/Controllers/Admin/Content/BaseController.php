<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers\Admin\Content;

use App\Content;
use App\Http\Controllers\Controller;
use App\Http\Requests\Content\BaseHomeContentRequest;
use App\Http\Requests\Content\BaseSpeakersContentRequest;
use App\Http\Requests\Content\BaseLoginRegisterContentRequest;
use App\Http\Requests\Content\BaseProgrammeContentRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class BaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function home()
    {
        $content = Content::GetContentVue('home', Auth::user()->conference);

        return view(
            'admin.content.base.home',
            [
                'content' => $content,
            ]
        );
    }


    public function homePost(BaseHomeContentRequest $r)
    {

        $content = [
            'meta_title'               => $r->input('meta_title'),
            'meta_description'         => $r->input('meta_description'),
            'countdown_enabled'        => $r->input('countdown_enabled'),
            'countdown_heading'        => $r->input('countdown_heading'),
            'countdown_background'     => $r->input('countdown_background'),
            'countdown_time'           => $r->input('countdown_time'),
            'countdown_date'           => $r->input('countdown_date'),
            'numbers_enabled'          => $r->input('numbers_enabled'),
            'numbers_heading'          => $r->input('numbers_heading'),
            'numbers_background'       => $r->input('numbers_background'),
            'numbers_figure_1_value'   => $r->input('numbers_figure_1_value'),
            'numbers_figure_1_percent' => $r->input('numbers_figure_1_percent'),
            'numbers_figure_1_value'   => $r->input('numbers_figure_1_value'),
            'numbers_figure_1_percent' => $r->input('numbers_figure_1_percent'),
            'numbers_figure_1_heading' => $r->input('numbers_figure_1_heading'),
            'numbers_figure_1_value'   => $r->input('numbers_figure_1_value'),
            'numbers_figure_1_percent' => $r->input('numbers_figure_1_percent'),
            'numbers_figure_2_heading' => $r->input('numbers_figure_2_heading'),
            'numbers_figure_2_value'   => $r->input('numbers_figure_2_value'),
            'numbers_figure_2_percent' => $r->input('numbers_figure_2_percent'),
            'numbers_figure_3_heading' => $r->input('numbers_figure_3_heading'),
            'numbers_figure_3_value'   => $r->input('numbers_figure_3_value'),
            'numbers_figure_3_percent' => $r->input('numbers_figure_3_percent'),
            'numbers_figure_4_heading' => $r->input('numbers_figure_4_heading'),
            'numbers_figure_4_value'   => $r->input('numbers_figure_4_value'),
            'numbers_figure_4_percent' => $r->input('numbers_figure_4_percent'),
            'numbers_figure_5_heading' => $r->input('numbers_figure_5_heading'),
            'numbers_figure_5_value'   => $r->input('numbers_figure_5_value'),
            'numbers_figure_5_percent' => $r->input('numbers_figure_5_percent'),
            'speakers_enabled'         => $r->input('speakers_enabled'),
            'speakers_heading'         => $r->input('speakers_heading'),
            'speakers_copy'            => $r->input('speakers_copy'),
            'speakers_button_copy'     => $r->input('speakers_button_copy'),
            'speakers_button_link'     => $r->input('speakers_button_link'),
            'programme_enabled'        => $r->input('programme_enabled'),
            'programme_heading'        => $r->input('programme_heading'),
            'programme_copy'           => $r->input('programme_copy'),
            'programme_copy_2'         => $r->input('programme_copy_2'),
            'programme_button_copy'    => $r->input('programme_button_copy'),
            'programme_button_link'    => $r->input('programme_button_link'),
            'push_enabled'             => $r->input('push_enabled'),
            'push_heading'             => $r->input('push_heading'),
            'push_background'          => $r->input('push_background'),
            'push_left_image'          => $r->input('push_left_image'),
            'push_left_heading'        => $r->input('push_left_heading'),
            'push_left_copy'           => $r->input('push_left_copy'),
            'push_left_link_copy'      => $r->input('push_left_link_copy'),
            'push_left_link_link'      => $r->input('push_left_link_link'),
            'push_right_image'         => $r->input('push_right_image'),
            'push_right_heading'       => $r->input('push_right_heading'),
            'push_right_copy'          => $r->input('push_right_copy'),
            'push_right_link_copy'     => $r->input('push_right_link_copy'),
            'push_right_link_link'     => $r->input('push_right_link_link'),
        ];

        $save = Content::SaveContent('home', $content);

        return response()->json(
            [
                'success' => true,
                'updated' => $save,
            ]
        );
    }


    public function speakers()
    {
        $content = Content::GetContentVue('speakers', Auth::user()->conference);

        return view(
            'admin.content.base.speakers',
            [
                'content' => $content,
            ]
        );
    }


    public function speakersPost(BaseSpeakersContentRequest $r)
    {

        $content = [
            'meta_title'            => $r->input('meta_title'),
            'meta_description'      => $r->input('meta_description'),
            'header_image_override' => $r->input('header_image_override'),
            'menu_title'            => $r->input('menu_title'),
            'menu_order'            => $r->input('menu_order'),
            'page_heading'          => $r->input('page_heading'),
            'page_subheading'       => $r->input('page_subheading'),
            'confirmed_heading'     => $r->input('confirmed_heading'),
            'previous_heading'      => $r->input('previous_heading'),
            'confirmed_text'        => $r->input('confirmed_text'),
            'previous_text'         => $r->input('previous_text'),
        ];

        $save = Content::SaveContent('speakers', $content);

        return response()->json(
            [
                'success' => true,
                'updated' => $save,
            ]
        );
    }


    public function programme()
    {
        $content = Content::GetContentVue('programme', Auth::user()->conference);

        return view(
            'admin.content.base.programme',
            [
                'content' => $content,
            ]
        );
    }


    public function programmePost(BaseProgrammeContentRequest $r)
    {

        $content = [
            'meta_title'            => $r->input('meta_title'),
            'meta_description'      => $r->input('meta_description'),
            'header_image_override' => $r->input('header_image_override'),
            'menu_title'            => $r->input('menu_title'),
            'menu_order'            => $r->input('menu_order'),
            'page_heading'          => $r->input('page_heading'),
            'page_subheading'       => $r->input('page_subheading'),
        ];

        $save = Content::SaveContent('programme', $content);

        return response()->json(
            [
                'success' => true,
                'updated' => $save,
            ]
        );
    }


    public function register()
    {
        $content = Content::GetContentVue('register', Auth::user()->conference);

        return view(
            'admin.content.base.register',
            [
                'content' => $content,
            ]
        );
    }


    public function registerPost(BaseLoginRegisterContentRequest $r)
    {

        $content = [
            'meta_title'            => $r->input('meta_title'),
            'meta_description'      => $r->input('meta_description'),
            'header_image_override' => $r->input('header_image_override'),
            'menu_title'            => $r->input('menu_title'),
            'menu_order'            => $r->input('menu_order'),
            'page_heading'          => $r->input('page_heading'),
            'page_subheading'       => $r->input('page_subheading'),
        ];

        $save = Content::SaveContent('register', $content);

        return response()->json(
            [
                'success' => true,
                'updated' => $save,
            ]
        );
    }


    public function login()
    {
        $content = Content::GetContentVue('login', Auth::user()->conference);

        return view(
            'admin.content.base.login',
            [
                'content' => $content,
            ]
        );
    }


    public function loginPost(BaseLoginRegisterContentRequest $r)
    {

        $content = [
            'meta_title'            => $r->input('meta_title'),
            'meta_description'      => $r->input('meta_description'),
            'header_image_override' => $r->input('header_image_override'),
            'menu_title'            => $r->input('menu_title'),
            'menu_order'            => $r->input('menu_order'),
            'page_heading'          => $r->input('page_heading'),
            'page_subheading'       => $r->input('page_subheading'),
        ];

        $save = Content::SaveContent('login', $content);

        return response()->json(
            [
                'success' => true,
                'updated' => $save,
            ]
        );
    }
}
