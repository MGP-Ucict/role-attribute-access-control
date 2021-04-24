@extends('layouts.app')
@section('content')
<div class="container">
	@include('rolespermissions.header')
	<div class="panel panel-default">
		<div class="panel-heading"><h1>{{trans('lang::translation.CreatePermission')}}</h1></div>
			<div class="panel-body">
				@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
					
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif	
				<form action="{{ route('permissions.store')}}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="name">{{trans('lang::translation.Name')}}:</label>
					<input type="text" name="name" class="form-control" />
				</div>
				<div class="form-group">
					<label for="route">{{trans('lang::translation.Route')}}:</label>
					<input type="text" name="route" class="form-control" />
				</div>
				<div class="form-group">
					<label for="method">{{trans('lang::translation.Method')}}:</label>
					<select name="method" class="form-control">
						<option value="GET">GET</option>
						<option value="POST">POST</option>
						<option value="PUT">PUT</option>
						<option value="DELETE">DELETE</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" value="{{trans('lang::translation.Save')}}" class="btn btn-primary" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
