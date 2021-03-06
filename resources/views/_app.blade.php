<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRS</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/reset.cs') }}" rel="stylesheet">
	<link href="{{ asset('/css/audioplayer.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body onkeydown="return false">
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">CRS</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					@if (Auth::guest())
					@else
						@if (Auth::user()->access_level == 1)
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> Clients <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('client') }}">Clients List</a></li>
									<li><a href="{{ url('client/create') }}">Add Clients</a></li>
								</ul>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-headphones"></i> Recordings <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('/recordings') }}">Recordings List</a></li>
									<li><a href="{{ url('/recordings/create') }}">Add Recordings</a></li>
								</ul>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-tasks"></i> Designations <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('/designations') }}">Designation List</a></li>
									<li><a href="{{ url('/designations/create') }}">Add Designation</a></li>
								</ul>
							</li>

							
							<li><a href="{{ url('/users') }}"><i class="glyphicon glyphicon-exclamation-sign"></i> Users Activation</a></li>
						@else
							<li><a href="{{ url('/') }}">Home</a></li>	
						@endif
						
						
					@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="{{ asset('js/audioplayer.js') }}"></script>
	<script>$( function() { $( 'audio' ).audioPlayer(); } );</script>
	<script>
		/* Disable Right Click */
		$(document).ready(function()
		{ 
		       $(document).bind("contextmenu",function(e){
		              return false;
		       });
		});
</script>
</body>
</html>
