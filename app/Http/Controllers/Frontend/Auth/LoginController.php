<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Content;
use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Conference;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        attemptLogin as attemptLoginAtAuthenticatesUsers;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';


    public function __construct(Conference $conference)
    {
    	$this->redirectTo = General::conferenceRoute('frontend.index');
        $this->middleware('delegate.guest', ['except' => 'logout']); // TODO: hook up to delegate middleware guards
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Conference $conference)
    {
    	//TODO: Return to prev solution if need
//    	$data = [
//		    'global' => $conference->content->where('page', 'global')->keyBy('identifier'),
//		    'login'  => $conference->content->where('page', 'login')->keyBy('identifier'),
//	    ];
	    $data = [
		    'global' => Content::GetContent('global', $conference),
		    'login'  => Content::GetContent('login', $conference),
	    ];
        return view(
            'frontend.themes.'.$conference->frontend_theme.'.login',
	        $data
        );
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect(General::conferenceRoute('frontend.login'));
    }


    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
//	    return $this->guard()->attempt(
//		    $this->credentials($request), $request->has('remember'), 'enabled'
//	    );
        return $this->attemptLoginAtAuthenticatesUsers($request);
    }


    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function credentials(Request $request)
    {
        $creds = $request->only($this->username(), 'password');
        $creds['enabled'] = true;

        return $creds;
    }

	protected function guard()
	{
		return Auth::guard('delegate');
	}
}
