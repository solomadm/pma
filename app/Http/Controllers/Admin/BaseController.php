<?php namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Http\Controllers\Controller;

class BaseController extends Controller {
    protected function getActiveConferenceId() {
        /** @var User $self */
        $self = Auth::user();

        return $self->getActiveConferenceId();
    }
}