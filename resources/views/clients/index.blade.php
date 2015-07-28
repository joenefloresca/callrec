@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Client List</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="flash-message">
				        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
				          @if(Session::has('alert-' . $msg))
				          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
				          @endif
				        @endforeach
			        </div>
			      <div >
			        {!! Html::ul($errors->all()) !!}
			      </div>
			       @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                     @endif
					<table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Client</td>
                                        <td>Date Created</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($client as $key => $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->ClientName }}</td>
                                        <td>{{ $value->created_at }}</td>
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
