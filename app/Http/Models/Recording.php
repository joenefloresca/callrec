<?php namespace App\Http\Models;
use DB;

class Recording extends \Eloquent  {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'recordings';

	public function showRecordPublic($Hash)
	{
		$publicRecord = DB::select("SELECT Path FROM recordings WHERE Hash_Key = :Hash_Key", ['Hash_Key' => $Hash]);
        return $publicRecord;
	}

}