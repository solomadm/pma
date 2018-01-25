<?php

namespace App\Http\Controllers\Frontend;

use App\Conference;
use App\Content;
use App\Http\Controllers\Controller;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class ConferenceController extends Controller {

    public function index(Conference $conference) {
        return view(
            'frontend.themes.'.$conference->frontend_theme.'.home',
            [
                'global'            => Content::GetContent('global', $conference),
                'home'              => Content::GetContent('home', $conference),
                'featured_speakers' => $conference->speakers->where('featured', 1),
            ]
        );
    }
}
