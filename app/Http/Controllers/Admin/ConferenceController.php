<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers\Admin;

use App\Conference;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateConferenceRequest;
use App\Http\Requests\EditConferenceRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class ConferenceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.conference.index');
    }

    /**
     * @param $conference
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function get(Conference $conference)
    {
        return $conference;
    }

    public function createPost(CreateConferenceRequest $r)
    {
        $conf = new Conference;

        $conf->name = $r->input('name');
        $conf->admin_theme = $r->input('admin_theme');
        $conf->frontend_theme = $r->input('frontend_theme');
        $conf->url_slug = $r->input('url_slug');
        $conf->enabled = 1;
        $conf->published = 0;

        $conf->save();

        Auth::user()->switchConference($conf->id);

        return response()->json(
            [
                'success' => true,
            ]
        );
    }


    public function edit(EditConferenceRequest $r, Conference $conference)
    {
        $conference->name = $r->input('name');
        $conference->frontend_theme = $r->input('frontend_theme');
        $conference->admin_theme = $r->input('admin_theme');
        $conference->enabled = $r->input('enabled');

        $conference->save();

        return response()->json(
            [
                'success' => true,
            ]
        );
    }


    public function editPost(CreateConferenceRequest $r, $id)
    {
        return response()->json(
            [
                'success' => true,
            ]
        );
    }


    public function delete($id)
    {
        return back();
    }
}
