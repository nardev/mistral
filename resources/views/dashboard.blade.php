@extends('app')

@section('content')
<div class="row" style="min-height: 700px; padding: 10px 0 50px 0;">
        <div class="col-sm-6 col-md-6">
		
		<h3 class="text-center">All todo lists ({{$user->groups->count()}})</h3>
		
			<div class="list-group">
			@foreach ($user->groups as $group)
			  <a href="javascript:void(0);" class="list-group-item" id="">
			   <span class="pull-left" style="margin-right: 20px;">
			      <button class="btn btn-xs btn-info getTasks" id="{{$group->id}}">SHOW</button>
			      <button class="btn btn-xs btn-warning archiveGroup" id="{{$group->id}}">ARCHIVE</button>
			    </span>
				    	{{$group->name}}
			    	<span class="badge">{{$group->tasks->count()}}</span>
			  </a>
			@endforeach
			</div>

			<div>
				<form class="form-inline text-center" role="form" id="newGroup">
				  <div class="form-group">
				    <input type="text" class="form-control" id="name" name="name" placeholder="New List Name" size="30">
				  </div>
				  <button type="submit" class="btn btn-info" id="createGroup">Create New List</button>
				</form>
			</div>	
        </div>

        <div class="col-sm-6 col-md-6" id="tasks">
        	
        </div>
</div>
@endsection


@section('script')
<script type="text/javascript">

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$('.getTasks').click(function(event){
		event.preventDefault();

	    $.ajax({
	        type        : 'GET',
	        url         : 'getTasks/'+$(this).attr('id'),
	        dataType    : 'html',
	        encode      : true,
	        success: function(result){$("#tasks").html(result); }
	    })
	    .done(function(data) {
	    	
	    });
	});

	$('.archiveGroup').click(function(event){
		event.preventDefault();

	    $.ajax({
	        type        : 'GET',
	        url         : 'archiveGroup/'+$(this).attr('id'),
	        dataType    : 'html',
            data        : "",
	        encode      : true,
	        success: function(result){$("#tasks").html(result); }
	    })
	    .done(function(data) {
	    	window.setTimeout(function(){location.reload()},1000)
	    });

	});

	$('#createGroup').click(function(event){
		event.preventDefault();

	    $.ajax({
	        type        : 'POST',
	        url         : 'createGroup',
	        dataType    : 'html',
            data        : $('#newGroup').serialize(),
	        encode      : true,
	        success: function(result){$("#tasks").html(result); }
	    })
	    .done(function(data) {
	    	window.setTimeout(function(){location.reload()},1000)
	    });
	});

</script>
@endsection