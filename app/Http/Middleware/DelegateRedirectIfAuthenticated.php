<?php

namespace App\Http\Middleware;

use App\Helpers\General;
use Closure;
use Illuminate\Support\Facades\Auth;

class DelegateRedirectIfAuthenticated {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @param  string|null $guard
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next, $guard = null ) {

		if ( Auth::guard( 'delegate' )->check() ) {
			return redirect(General::conferenceRoute('frontend.index'));
		}

		return $next( $request );
	}
}
