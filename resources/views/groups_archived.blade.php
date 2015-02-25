@extends('app')

@section('content')
<div class="row" style="min-height: 700px; padding: 10px 0 50px 0;">
        <div class="col col-sm-12 col-md-12">
		
		<h3 class="text-center">Archived lists ({{$user->groups->count()}})</h3>
		
			@if ($user->groups->count() != 0)
				<div class="list-group">
					@foreach ($user->groups as $group)
					  <a href="javascript:void(0);" class="list-group-item" id="">
					   <span class="pull-left" style="margin-right: 20px;">
					      <button class="btn btn-xs btn-success activateGroup" id="{{$group->id}}">Return To Active</button>
					      <button class="btn btn-xs btn-danger deleteGroup" id="{{$group->id}}">Delete Permanently</button>
					    </span>
						    	{{$group->name}}
					    	<span class="badge">{{$group->tasks->count()}}</span>
					  </a>
					@endforeach
				</div>
			@else
				<div class="alert alert-danger" role="alert">
				  No Archived Lists
				</div>
			@endif

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

	$('.activateGroup').click(function(event){
		event.preventDefault();

	    $.ajax({
	        type        : 'GET',
	        url         : 'activateGroup/'+$(this).attr('id'),
	        dataType    : 'html',
	        encode      : true,
	        success: function(result){$(".col").prepend(result); }
	    })
	    .done(function(data) {

	    	window.setTimeout(function(){location.reload()},1000)
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
	    .done(function(data) {window.setTimeout(function(){location.reload()},1000)});
	});

</script>
@endsection