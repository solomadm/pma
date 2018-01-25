<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    protected $guarded = ['id'];

    protected $table = 'medias';


    /**
     * Get the related data
     */
    public function photo()
    {
        return $this->hasOne('App\ConferenceAsset', 'id', 'photo');
    }


    /**
     * Get the related data
     */
    public function article1()
    {
        return $this->hasOne('App\ConferenceAsset', 'id', 'article1');
    }


    /**
     * Get the related data
     */
    public function article2()
    {
        return $this->hasOne('App\ConferenceAsset', 'id', 'article2');
    }


    /**
     * Get the related data
     */
    public function article3()
    {
        return $this->hasOne('App\ConferenceAsset', 'id', 'article3');
    }
}
