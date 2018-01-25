<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class Speaker extends Model {

    public function conference() {
        return $this->belongsTo('App\Conference');
    }


    public function getRouteKeyName() {
        return 'id';
    }
}
