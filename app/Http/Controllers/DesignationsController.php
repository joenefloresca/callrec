<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;
use DB;

class DesignationsController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
    public function index()
    {
        $designation = new \App\Http\Models\Designation;
        $userRecordings = $designation->getUserRecordingsAll();

        return view('designations/index')->with(array('userRecordings' => $userRecordings));
    }

	public function create()
	{
		$user_options = array('' => 'Choose One') + DB::table('users')->where(array('access_level' => 0, 'status' => 1))->lists('name','id');
        $recording_options = array('' => 'Choose One') + DB::table('recordings')->where('status', '1')->lists('ClientName','id');
                
		return view('designations/create')->with(array('user_options'=>$user_options, 'recording_options' => $recording_options));
	}

	public function store()
	{


       $messages = array(
            'unique_multiple' => 'Sorry, This User and Client has been designated.',
        );

       Validator::extend('unique_multiple', function ($attribute, $value, $parameters)
        {
            // Get table name from first parameter
            $table = array_shift($parameters);

            // Build the query
            $query = DB::table($table);
            // Add the field conditions
            foreach ($parameters as $i => $field)
                $query->where($field, $value[$i]);

            // Validation result will be false if any rows match the combination
            return ($query->count() == 0);
        });

        $validator = Validator::make(
            // Validator data goes here
            array(
                'unique_fields' => array(Input::get('user'), Input::get('recording')),
            ),
            // Validator rules go here
            array(
                'unique_fields' => 'unique_multiple:designations,Users_id,Recordings_id',
            
            ),
            $messages
        );

        // Check if all fields is filled
        if ($validator->fails()) 
        {
            return Redirect::to('designations/create')->withErrors($validator);
        }
        else
        {
        	$designation = new \App\Http\Models\Designation;
            $designation->Users_id = Input::get('user');
            $designation->Recordings_id = Input::get('recording');
      
            $designation->save();

            Session::flash('alert-success', 'Form Submitted Successfully.');

            return Redirect::to('designations/create');
        }

		return view('designations/create');
	}

    public function destroy($id)
    {
        // delete
        $designations = \App\Http\Models\Designation::find($id);
        $designations->delete();
        // redirect
        Session::flash('message', 'Successfully deleted the desgination!');
        return Redirect::to('/designations');
    }



}