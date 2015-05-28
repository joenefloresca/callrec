<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;
use File;

class RecordingsController extends Controller {
	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

	public function index()
    {
        $recordings = new \App\Http\Models\Recording;
  	

        return view('recordings/index')->with(array('recordings' => $recordings->all()));
    }

	public function create()
	{
		return view('recordings/create');
	}

	public function store()
	{
		 // Validate
        $rules = array(
            'ClientName'                         => 'required|unique:recordings',
            'FileUpload'                        => 'required|mimes:audio/mpeg,obb,wav,mp3',
        );

        $validator = Validator::make(Input::all(), $rules);

        // Check if all fields is filled
        if ($validator->fails()) 
        {
            return Redirect::to('recordings/create')->withErrors($validator);
        }
        else
        {
        	$recordings = new \App\Http\Models\Recording;
            $recordings->ClientName = Input::get('ClientName');
            /* For File Upload */
     		$file                = Input::file('FileUpload');
     		$filename            = $file->getClientOriginalName();
     		$destinationPath 	 = "uploads/".Input::get('ClientName'); 
            $uploadSuccess 		 = Input::file('FileUpload')->move($destinationPath, $filename);

            $recordings->Path 	  = $destinationPath."/".$filename;
            $recordings->FileName = $filename;
            $recordings->save();

            Session::flash('alert-success', 'Form Submitted Successfully.');

            return Redirect::to('recordings/create');
        }

		return view('recordings/create');
	}

	public function destroy($id)
    {
        // delete
        $recordings = \App\Http\Models\Recording::find($id);
        $recordings->delete();
        

        /* Delete directory */
        $dir = 'C:/wamp/www/callrec/public/uploads/'.$recordings->ClientName;
        File::deleteDirectory($dir);

        /* Delete from designation */
        $designation = new \App\Http\Models\Designation;
        $result = $designation->deleteRecording($id); // Return 1 if success
        
        // redirect
        Session::flash('message', 'Successfully deleted the recording!');
        return Redirect::to('/recordings');
    }



}