<?php

namespace App\Providers;

use App\Delegate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		\Schema::defaultStringLength( 191 );

		Validator::extend( 'image64', function ( $attribute, $value, $parameters, $validator ) {
            if (empty($value['file'])) {
                return false;
            }
            $type = explode('/', explode(':', substr($value['file'], 0, strpos($value['file'], ';')))[1])[1];
			if ( in_array( $type, $parameters ) ) {
				return true;
			}

			return false;
		} );

		Validator::replacer( 'image64', function ( $message, $attribute, $rule, $parameters ) {
			return str_replace( ':values', join( ",", $parameters ), $message );
		} );

		Validator::extend( 'uic_user', function ( $attribute, $value, $parameters, $validator ) {
			if(empty($parameters)) {
				return false;
			}
			if(Delegate::where('uic', $value)->where('email', array_shift($parameters))->first()) {
				return true;
			}
			return false;
		} );
	}


	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		if ( $this->app->environment( 'local', 'testing' ) ) {
			$this->app->register( DuskServiceProvider::class );
		}
	}
}
