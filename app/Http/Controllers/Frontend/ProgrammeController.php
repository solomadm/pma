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
class ProgrammeController extends Controller
{

    public function index(Conference $conference)
    {
        return view(
            'frontend.themes.'.$conference->frontend_theme.'.programme',
            [
                'global'    => Content::GetContent('global', $conference),
                'programme' => Content::GetContent('programme', $conference),
            ]
        );
    }
}
