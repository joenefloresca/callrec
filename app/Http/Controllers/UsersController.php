<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;

class UsersController extends Controller {
	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

	public function index()
    {
        $users = new \App\User;
        return view('users/index')->with(array('users' => $users->getUnApprovedUsers()));
    }

    public function activate($id)
    {
        $users = new \App\User;
        $users->activateUser($id);
        Session::flash('message', 'Successfully activated the user!');
        return Redirect::to('users');


    }



}