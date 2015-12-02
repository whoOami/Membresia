<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Members;
use App\Models\Groups;


class GroupsController extends Controller {

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
		$groups=Groups::get();
		return response()->json([
				"msg"=>"Success",
				"groups"=>$groups->toArray()
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
		$group=Groups::create($request->all());
		return response()->json([
				"msg"=>"Success",
				"id"=>$group->id
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
		$group=Groups::find($id);
		return response()->json([
				"msg"=>"Success",
				"group"=>$group
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
		$group=Groups::find($id);
		$group->update($request->all());
		return response()->json([
				"msg"=>"Success"
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
		if (Members::membersInGroup($id)>0){
			return response()->json([
					"msg"=>"!empty"
				],200
			);
		}
		$group=Groups::destroy($id);
		return response()->json([
				"msg"=>"Success"
			],200
		);
	}

}
