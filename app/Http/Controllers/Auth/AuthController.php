<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use ResetsPasswords;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	protected	$redirectTo = "groups";

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}


	public function postEmail(Request $request)
	{
	    $this->validate($request, ['email' => 'required']);

	    $response = $this->passwords->sendResetLink($request->only('email'), function($message)
	    {
	        $message->subject('Password Reminder');
	    });

	    switch ($response)
	    {
	        case PasswordBroker::RESET_LINK_SENT:
	            return redirect()->back()->with('status', trans($response));

	        case PasswordBroker::INVALID_USER:
	            return redirect()->back()->withErrors(['email' => trans($response)]);
	    }
	}

}
