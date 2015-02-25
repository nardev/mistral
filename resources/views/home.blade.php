@extends('app')

@section('content')
<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-default">
		<div class="panel-heading">Welcome</div>

		<div class="panel-body">
			To use this App you must <a href="{{URL::to('auth/login')}}">login</a>!
		</div>
	</div>
</div>
@endsection
