<?php
namespace App;

use Schema;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/**
 * @mixin \Eloquent
 */
class Delegate extends Authenticatable {

	use Notifiable;

    public $table = "delegates";
//    public $fillable = ['*'];
    public $guarded = ['id', 'conference_id', 'email', 'password', 'uic'];
    public $hidden = ['password'];

    public function conference() {
        return $this->belongsTo('App\Conference');
    }

    public function getFillableColumns() {
        $delegate = new Delegate();
        $delegateTable = $delegate->getTable();

        $forbiddenValues = ['id', 'conference_id', 'remember_token', 'created_at', 'updated_at', 'photo'];
        $columns = Schema::getColumnListing($delegateTable);

        foreach($columns as $k => $v) {
            if(in_array($v, $forbiddenValues)) {
                unset($columns[$k]);
            }
        }

        return array_values($columns);
    }
}
