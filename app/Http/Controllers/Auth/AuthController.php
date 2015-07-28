<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Session;
use Redirect;


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

	public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);
        if ($this->auth->validate(['email' => $request->email, 'password' => $request->password, 'status' => 0])) 
        {
            return redirect($this->loginPath())
                ->withInput($request->only('email', 'remember'))
                ->withErrors('Your account is Inactive or not yet verified');
        }

        $credentials  = array('email' => $request->email, 'password' => $request->password);

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
        		
    		if(\Auth::user()->access_level == 1)
    		{
    			return Redirect::to('/recordings');
    		}
    		else
    		{
    			return redirect()->intended($this->redirectPath());
    		}
                
        }

        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Incorrect email address or password',
            ]);
    }

	public function postRegister(Request $request)
	{
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		$this->registrar->create($request->all());
		/* Send Email to Admin */
		// $access = "";
		// $request->access_level == 1 ? $access = "Admin / QA" : $access = "Client";
		// $msg = "New Registration  \n Username: ".$request->name."\n Email: ".$request->email."\n Access Level :".$access;
		// $msg = wordwrap($msg,70);
		//mail("joene.floresca@qdf-phils.com","New Registration",$msg);
		//mail("joenefloresca@gmail.com","New Registration",$msg);


		Session::flash('alert-success', 'Successfully registered.');
        return Redirect::to('auth/register');
	}

	public function getLogout()
	{
		$this->auth->logout();

		return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/auth/login');
	}

}
