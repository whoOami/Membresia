<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Members;
use App\Models\Groups;


class MembersController extends Controller {

	public function __construct(){
       $this->middleware('jwt.auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$members=Members::get();
		foreach ($members as $member){
			if($member->group==null){
				$member->group="";
			}
		}
		//var_dump($members);
		return response()->json([
				"msg"=>"Success",
				"items"=>$members
			],200
		);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$member=Members::create($request->all());
		return response()->json([
				"msg"=>"Success",
				"id"=>$member->id
			],200
		);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function read($id)
	{
		$member=Members::find($id);
		return response()->json([
				"msg"=>"Success",
				"member"=>$member
			],200
		);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$group=Groups::find($request->group_id);
		$member=Members::find($id);
		$member->update($request->all());
		$member->group=$group->name;
		return response()->json([
				"msg"=>"Success",
				"member"=>$member
			],200
		);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$member=Members::destroy($id);
		return response()->json([
				"msg"=>"Success"
			],200
		);
	}

}
