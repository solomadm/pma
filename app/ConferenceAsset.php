<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class ConferenceAsset extends Model {
    public function conference() {
        return $this->belongsTo('App\Conference');
    }
}
