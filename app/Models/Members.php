<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Members extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'members';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first'
		,'last'
		,'identification'
		,'mobile'
		,'home'
		,'address'
		,'district'
		,'birthdate'
		,'active'
		,'note'
		,'avatar'
		,'civil_status'
		,'labor_status'
		,'educational_level'
		,'sunday_school_group'
		,'group'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/*
	 * Consultas...
	 */
	public static function get(){
		$return= \DB::table('members')
			->leftjoin('groups', 'members.group', '=', 'groups.id')
			->select('members.*','members.group as group_id', 'groups.name as group')
			->get();
		return $return;
	}
	public static function membersInGroup($id){
		$return= \DB::table('members')->where('group',$id)->count();
		return $return;
	}
}

