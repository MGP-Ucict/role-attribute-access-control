@extends('layouts.app')
@section('content')
<div class="container">
@include('rolespermissions.header')
<div class="panel panel-default">
	<div class="panel-heading"><h1>{{trans('lang::translation.UpdateRoute')}}</h1></div>
		<div class="panel-body">
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif 
			<form action="{{ route('permissions.update', $permission->id)}}" method="post">
				@method('PUT')
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="name">{{trans('lang::translation.Name')}}:</label>
					<input type="text" name="name" class="form-control" value="{{$permission->name}}" />
				</div>
				<div class="form-group">
					<label for="route">{{trans('lang::translation.Route')}}:</label>
					<input type="text" name="route" class="form-control" value="{{$permission->route}}" />
				</div>
				<div class="form-group">
					<label for="method">{{trans('lang::translation.Method')}}:</label>
					<select name="method" class="form-control">
						<option value="GET" {{ ( $permission->method == "GET") ? 'selected' : '' }} >GET</option>
						<option value="POST" {{ ( $permission->method == "POST") ? 'selected' : '' }} >POST</option>
						<option value="PUT" {{ ( $permission->method == "PUT") ? 'selected' : '' }} >PUT</option>
						<option value="DELETE" {{ ( $permission->method == "DELETE") ? 'selected' : '' }} >DELETE</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" value="{{trans('lang::translation.Save')}}" class="btn btn-primary" />
				</div>
			</form>
		</div>
	</div>
 </div>
@endsection
