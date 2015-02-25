<div class="list-group">

	<h3 class="text-center">{{$group->name}} <button type="button" class="btn btn-xs btn-danger pull-right deleteGroup" id="{{$group->id}}">Delete List</button> </h3>

	<div class="tasks-box">
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
	</div>

	<div class="">
	  <form role="form" id="newTask">
	  <input type="hidden" class="form-control" name="group_id" value="{{$group->id}}">
	    <div class="form-group">
	      <input type="title" class="form-control" name="title" id="title" placeholder="Title">
	    </div>
	    <div class="form-group">
	      <input type="text" class="form-control" name="text" id="text" placeholder="Text">
	    </div>
	    <button type="button" class="btn btn-info pull-right" id="createTask">Add New Task</button>
	  </form>
	    <div class="clearfix"></div>
	</div>

</div>

<script type="text/javascript">
	

	$('.statusTask').click(function(event){
		event.preventDefault();

	    $.ajax({
	        type        : 'GET',
	        url         : 'statusTask/'+$(this).attr('id'),
	        dataType    : 'html',
	        encode      : true,
	        success: function(result){$(".tasks-box").prepend(result); }
	    })
	    .done(function(data) {
	    	window.setTimeout(function(){
	    		$("#tasks").load('getTasks/'+{{$group->id}})
	    	},1000);
	    });
	});

	$('.deleteTask').click(function(event){
		event.preventDefault();

	    $.ajax({
	        type        : 'GET',
	        url         : 'deleteTask/'+$(this).attr('id'),
	        dataType    : 'html',
	        encode      : true,
	        success: function(result){$(".tasks-box").prepend(result); }
	    })
	    .done(function(data) {
	    	window.setTimeout(function(){
	    		$("#tasks").load('getTasks/'+{{$group->id}})
	    	},1000);
	    });
	});


	$('#createTask').click(function(event){
		event.preventDefault();

	    $.ajax({
	        type        : 'POST',
	        url         : 'createTask/'+{{$group->id}},
	        dataType    : 'html',
            data        : $('#newTask').serialize(),
	        encode      : true,
	        success: function(result){$(".tasks-box").prepend(result); },
	        error: function(result){$(".tasks-box").prepend('<div class="alert alert-danger error" role="alert">ERROR</div>'); setTimeout('$(".error").hide()',2000);}
	    })
	    .done(function(data) {
	    	window.setTimeout(function(){
	    		$("#tasks").load('getTasks/'+{{$group->id}})
	    	},1000);
	    });
	});


	$('.deleteGroup').click(function(event){
		event.preventDefault();

	    $.ajax({
	        type        : 'GET',
	        url         : 'deleteGroup/'+$(this).attr('id'),
	        dataType    : 'html',
	        encode      : true,
	        success: function(result){$(".col").prepend(result); }
	    })
	    .done(function(data) {
	    	window.setTimeout(function(){location.reload()},1000)
	    });
	});

</script>