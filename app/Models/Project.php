<?php

namespace App;

use Auth;
use Request;
use App\Notifications\AddedToProject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'code', 'title', 'description', 'start_date', 'end_date', 'status', 'price',
	];

	/**
	 * Executed when loading model
	 */
	public static function boot()
	{
		parent::boot();
		Project::updated(function($user) {
			$log = new ActivityLog;
			$log->user_id   		= Auth::id() ? Auth::id() : '1';
			$log->description		= 'projectupdated;' . $user->id;
			$log->ip_address		= Request::ip();
			$log->save();  // Insert the new log
		});
		Project::created(function($user) {
			$log = new ActivityLog;
			$log->user_id   		= Auth::id() ? Auth::id() : '1';
			$log->description		= 'projectcreated;' . $user->id;
			$log->ip_address		= Request::ip();
			$log->save();  // Insert the new log
		});
		Project::deleted(function($user) {
			$log = new ActivityLog;
			$log->user_id   		= Auth::id() ? Auth::id() : '1';
			$log->description		= 'projectdeleted;' . $user->id;
			$log->ip_address		= Request::ip();
			$log->save();  // Insert the new log
		});
	}

	/**
	 * The employees that belong to the project.
	 */
	public function users()
	{
		return $this->belongsToMany('App\User');
	}

	/**
	 * The tasks that belong to the project.
	 */
	public function tasks()
	{
		return $this->hasMany('App\Task');
	}

    // TODO: Función getStatusColor() como en Ticket

}
