@extends('_app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<h1>My Recordings</h1> <br />
					<table class="table table-striped table-bordered">
					    <thead>
					        <tr>
					            <td>Name</td>
					            <td>Client Name</td>
					            <td>Audio Recoding</td>
					            <td>Date Uploaded</td>
					            <td>Public Link</td>
					        </tr>
					    </thead>
				        <tbody>
				        @foreach($userRecordings as $key => $value)
				            <tr>
				                <td>{{ $value->name }}</td>
				                <td>{{ $value->ClientName }}</td>
				                <!-- <td>{!! Html::link('http://localhost/callrec/public/'.$value->Path) !!}</td> -->
				                <td>
				                	<audio preload="auto" controls>
										<source src="http://localhost/callrec/public/{!! $value->Path !!}">
									</audio>
								</td>
								<td>
									{{ $value->dateUploaded }}
								</td>
								<td>
									<a href="http://localhost/callrec/public/recording/{!! $value->Hash_Key !!}">See Public Link</a>
								</td>
				            </tr>
				        @endforeach
				        </tbody>
				    </table> 
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
