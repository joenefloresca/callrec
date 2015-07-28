<?php namespace App\Http\Models;

use DB;

class Designation extends \Eloquent  {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'designations';

	public function getUserRecordings($userID)
	{
		$userRecordings = DB::select("SELECT a.name, c.ClientName, c.Path, c.FileName, c.Hash_Key, c.created_at AS dateUploaded FROM users a INNER JOIN designations b ON a.id = b.Users_id INNER JOIN recordings c ON b.Recordings_id = c.id where a.id = :id", ['id' => $userID]);
		return $userRecordings;
	}

	public function getUserRecordingsAll()
	{
		$userRecordings = DB::select("SELECT b.id, a.name, c.ClientName FROM users a INNER JOIN designations b ON a.id = b.Users_id INNER JOIN recordings c ON b.Recordings_id = c.id");
		return $userRecordings;
	}

	public function deleteRecording($recID)
	{
		$result = DB::table('designations')->where('Recordings_id', '=', $recID)->delete();
		return $result;
	}

}