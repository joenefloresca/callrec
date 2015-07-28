<?php namespace App\Http\Controllers;

use Validator;
use Input;
use Redirect;
use Session;
use File;
use FTP;
use Request;
use \App\Http\Models\Recording;
use \App\Http\Models\Designation;
use Hash;
use Config;
use DB;

class RecordingsController extends Controller {
	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
    {
        $recordings = new Recording();
  	

        return view('recordings/index')->with(array('recordings' => $recordings->all()));
    }

	public function create()
	{
        $client_options = array('' => 'Choose One') + DB::table('clients')->where('status', '1')->lists('ClientName','ClientName');
		return view('recordings/create')->with(array('client_options' => $client_options));
	}

	public function store()
	{
		 // Validate
        $rules = array(
            'ClientName'  => 'required|unique:recordings',
            'FileUpload'  => 'required|mimes:audio/mpeg,obb,wav,mp3',
        );

        $validator = Validator::make(Input::all(), $rules);

        // Check if all fields is filled
        if ($validator->fails()) 
        {
            return Redirect::to('recordings/create')->withErrors($validator);
        }
        else
        {

        	$recordings = new Recording();
            $recordings->ClientName = Input::get('ClientName');
            /* For File Upload */
     		$file                  = Input::file('FileUpload');
     		$filename              = $file->getClientOriginalName();
     		$destinationPath 	   = "uploads/".Input::get('ClientName'); 
            $uploadSuccess 		   = Input::file('FileUpload')->move($destinationPath, $filename);
            $recordings->Path 	   = $destinationPath."/".$filename;
            $recordings->FileName  = $filename;
            $recordings->Hash_Key  = base64_encode(Hash::make($recordings->id.Config::get('APP_KEY')));;
            $recordings->save();

            /* Upload to Remote Server via FTP Service*/
            $file_loc       = public_path()."\uploads\\".Input::get('ClientName').'\\'.$filename;
            $mkdir          = FTP::connection()->makeDir("CallRecordingsUpload/".Input::get('ClientName'));
            $change_ftp_dir = FTP::connection()->changeDir("CallRecordingsUpload/".Input::get('ClientName'));
            $ftp_upload     = FTP::connection()->uploadFile($file_loc, $filename);

            Session::flash('alert-success', 'Form Submitted Successfully.');

            return Redirect::to('recordings/create');
        }

		return view('recordings/create');
	}

	public function destroy($id)
    {
        $msg = "";
        // delete
        $recordings = Recording::find($id);
        $delRecord = $recordings->delete();

        /* Delete directory */
        $dir = 'C:/wamp/www/callrec/public/uploads/'.$recordings->ClientName;
        $delLocal = File::deleteDirectory($dir);

        /* Delete from designation */
        $designation = new Designation();
        //$result = 
        $designation->deleteRecording($id); // Return 1 if success

        /* Delete path from FTP Server */
        FTP::connection()->changeDir("CallRecordingsUpload/".$recordings->ClientName);
        $removeDir = FTP::connection()->removeDir("//CallRecordingsUpload/".$recordings->ClientName, true);

        if(!$delRecord)
        {
            $msg .= "Failed to delete record in database. Database connection error. \n";
        }
        if(!$delLocal)
        {
            $msg .= "Failed to delete file in the local folder. \n";
        }
        // if($result != '1' || $result != '0')
        // {
        //     $msg .= "Failed to delete record in designation. Database connection error. \n";
        // }
        if(!$removeDir)
        {
            $msg .= "Failed to delete file in the FTP Server. FTP connection error. \n";
        }

        if($msg == "")
        {
            $msg = "Successfully deleted the recording!";
        }
        
        // redirect
        Session::flash('message', $msg);
        return Redirect::to('/recordings');
    }

    public function showPublic($Hash)
    {
        $recordings = new Recording();
        return view('recordings.public-record')->with(array('recordings' => $recordings->showRecordPublic($Hash)));
    }

}