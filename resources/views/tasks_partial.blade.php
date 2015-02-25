@if ($group->tasks->count() != 0)
<div class="list-group tasks-list">
	@foreach ($group->tasks as $task)
		  <a href="#" class="list-group-item">
		    <h4 class="list-group-item-heading {{($task->status == 0) ? 'overline' : ''}}">{{$task->title}}</h4>
		    <p class="list-group-item-text"><span class="{{($task->status == 0) ? 'overline' : ''}}">{{$task->text}}</span>
			<br>
			<br>
			
			<button type="button" class="btn btn-xs {{($task->status == 0) ? 'btn-success' : 'btn-danger'}} statusTask" id="{{$task->id}}">
			{{($task->status == 0) ? 'Reactivate' : 'Completed'}}
			</button>

			<button type="button" class="btn btn-xs btn-danger deleteTask" id="{{$task->id}}">Delete Task</button> 
		    </p>
		  </a>
	@endforeach
</div>
@else
	<div class="alert alert-danger" role="alert">
	  List Empty
	</div>
@endif