<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers\Frontend;

use App\Conference;
use App\Speaker;
use App\Content;
use App\Http\Controllers\Controller;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class SpeakerController extends Controller
{

    public function index(Conference $conference)
    {
        return view(
            'frontend.themes.'.$conference->frontend_theme.'.speakers',
            [
                'global'      => Content::GetContent('global', $conference),
                'speakers'    => Content::GetContent('speakers', $conference),
                'speakerList' => $conference->speakers->groupBy('type'),
            ]
        );
    }

    public function profile(Conference $conference, Speaker $speaker)
    {
        return view(
            'frontend.themes.'.$conference->frontend_theme.'.speaker-profile',
            [
                'global'      => Content::GetContent('global', $conference),
                'speakers'    => Content::GetContent('speakers', $conference),
                'speakerList' => $conference->speakers->where('id', '!=', $speaker->id)->groupBy('type'),
                'profile'     => $speaker->toArray(),
            ]
        );
    }
}
