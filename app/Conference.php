<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class Conference extends Model {
    public function assets() {
        return $this->hasMany('App\ConferenceAsset')->orderBy('id', 'DESC');
    }

    public function getRouteKeyName() {
        return 'url_slug';
    }

    public function content() {
        return $this->hasMany('App\Content');
    }


    public function speakers() {
        return $this->hasMany('App\Speaker');
    }
}
