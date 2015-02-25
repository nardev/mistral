<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mistral</title>

	<link href="/css/app.css" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#" style="padding: 5px; margin: 0 40px 0 30px;"><img src="/images/logo.png" style="height: 40px;" alt=""></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">

			@if (!Auth::guest())
            <ul class="nav navbar-nav">
              <li class=""><a href="{{URL::to('groups')}}">Lists</a></li>
              <li class=""><a href="{{URL::to('archivedGroups')}}">Archived list</a></li>
            </ul>
			@endif

          	<ul class="nav navbar-nav navbar-right">
				@if (Auth::guest())
					<li><a href="/auth/login">Login</a></li>
					<li><a href="/auth/register">Register</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/auth/logout">Logout</a></li>
						</ul>
					</li>
				@endif
          	</ul>
          </div>
        </div><!--/.container-fluid -->
      </nav>

    </div> <!-- /container -->

	<div class="container">
		@yield('content')
	</div>


	<div class="container">
      <footer class="panel-footer">
        <p>&copy; Company 2014</p>
      </footer>
	</div>


	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	
	@yield('script')

</body>
</html>
