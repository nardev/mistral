<?php namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Group;
use App\Task;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\CreateTaskRequest;

class MainController extends Controller {

	public function index()
	{
		
		return view('home');
	}


	/********************************************************
	*							GROUPS
	*********************************************************/

	public function groups()
	{
		// get groups - tasks
		$id = Auth::id();
		$user = User::with(array('groups' => function($q){
			 		$q->where('status','=',1);
			 }))->where('id','=',$id)->first();

		return view('groups')->with('user',$user);
	}

	public function getGroups()
	{
		// get groups - tasks
		$id = Auth::id();
		$user = User::with(array('groups' => function($q){
			 		$q->where('status','=',1);
			 }))->where('id','=',$id)->first();

		return view('groups')->with('user',$user);
	}

	public function archivedGroup()
	{
		$id = Auth::id();
		$user = User::with(array('groups' => function($q){
			 		$q->where('status','=',0);
			 }))->where('id','=',$id)->first();

		return view('groups_archived')->with('user',$user);
	}

	public function createGroup(CreateGroupRequest $requests)
	{
		$group = new Group();
		$group->user_id = Auth::id();
		$group->name = $requests->name;
		$group->status = 1;
		$group->save();

		return '<div class="alert alert-success" role="alert">List Created</div>';
	}

	public function archiveGroup($gid)
	{
		$group = Group::find($gid);
		$group->status = 0;
		$group->save();
		return '<div class="alert alert-success" role="alert">List Archived</div>';
	}

	public function activateGroup($gid)
	{
		$group = Group::find($gid);
		$group->status = 1;
		$group->save();
		return '<div class="alert alert-success" role="alert">List Activated</div>';
	}

	public function deleteGroup($gid)
	{
		$group = Group::find($gid);
		$group->delete();

		return '<div class="alert alert-success" role="alert">List Deleted Permanently</div>';
	}


	/********************************************************
	*							TASKS
	*********************************************************/

	public function getTasks($gid)
	{
		$group = Group::with('tasks')->where('id','=',$gid)->first();
		
		return view('tasks')->with('group',$group);
	}

	public function getTasksAjax($gid)
	{
		$group = Group::with('tasks')->where('id','=',$gid)->first();
		
		return view('tasks_partial')->with('group',$group);
	}

	public function createTask(CreateTaskRequest $requests, $gid)
	{
		$task = new Task;
		$task->group_id = $requests->group_id;
		$task->title = $requests->title;
		$task->text = $requests->text;
		$task->status = 1;
		$task->save();

		return '<div class="alert alert-success" role="alert">Task Created</div>';
	}

	public function statusTask($tid)
	{
		$task = Task::find($tid);
		$task->status = ($task->status == 1) ? 0 : 1;
		$task->save();
		return '<div class="alert alert-success" role="alert">Task\'s status changed!</div>';
	}

	public function deleteTask($tid)
	{
		$task = Task::find($tid);
		$task->delete();

		return '<div class="alert alert-success" role="alert">Task Deleted Permanently</div>';		
	}

}
