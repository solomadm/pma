<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin \Eloquent
 */
class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    public function conference() {
        return $this->belongsTo('App\Conference', 'current_conference', 'id');
    }

    public function switchConference($conf_id) {
        $admin = Auth::user();
        $admin->current_conference = $conf_id;
        $admin->save();

        return true;
    }

    public function getActiveConferenceId() {
        return $this->current_conference;
    }
}
