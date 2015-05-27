<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'access_level'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function getUnApprovedUsers()
	{	
		$userData = DB::select("SELECT id, name, email, status from users where status = 0 AND access_level = 0");
		return $userData;
	}

	public function activateUser($userID)
	{
		$userData = DB::table('users')->where('id', $userID)->update(array('status' => 1));
		return $userData;
	}

	public function isUserActivated($id)
	{
		$userData = DB::select("SELECT status from users where id = :id", ['id' => $id]);
		return $userData;
	}

}
