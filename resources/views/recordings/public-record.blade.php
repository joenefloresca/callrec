@extends('_app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-info">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<h1>My Recordings</h1> <br />
					<audio preload="auto" controls>
						<source src="http://localhost/callrec/public/{!! $recordings[0]->Path !!}">
					</audio>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
