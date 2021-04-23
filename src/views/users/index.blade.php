@extends('layouts.app')

@section('content')
<div class="container">
@include('rolespermissions.header')
	<div class="panel panel-default">
        <div class="panel-heading">{{trans('lang::translation.ListUsers')}}</div>
			<div class="panel-body">
				@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
				<table class="table table-striped">
				  <thead class="thead">
					<tr>
					  <th scope="col">#</th>
					  <th scope="col">{{trans('lang::translation.Username') }}</th>
					  <th scope="col">{{trans('lang::translation.Name') }}</th>
					  <th scope="col">{{trans('lang::translation.Email') }}</th>
					  <th scope="col">{{trans('lang::translation.Actions') }}</th>
					</tr>
				  </thead>
				  <tbody>
				@foreach($users as $user)
				@if($user->is_active)
				<tr>
				@else 
					<tr style="color:red;">
				@endif
				<td scope="row">{{$user->id}}</td> 
				<td>{{$user->username}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>
				@path('users.edit')
					<a href="{{route('users.edit', $user->id)}}" class="btn btn-warning"> {{trans('lang::translation.Edit')}}</a>
				@endpath
				@path('users.destroy')
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$user->id}}">
						{{trans('lang::translation.Delete')}}
					</button>

						<!-- Modal -->
						<div class="modal fade" id="deleteModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">{{trans('lang::translation.ConfirmDelete')}}</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
								<div class="modal-body">
									<form action="{{ route('users.destroy', $user->id)}}" method="post">
										@method('DELETE')
										<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
										{{trans('lang::translation.Do you really want to delete')}} <b>{{$user->name}}</b>?
										<br>
										<input type="submit" class="btn btn-danger" value="{{trans('lang::translation.Delete')}}"/>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('lang::translation.No')}}</button>
									</form>
								</div>
							</div>
						</div>
				@endpath
				</td>
				</tr>
				@endforeach
			</tbody>
			</table>
			@path('users.create')
				<a href="{{route('users.create')}}" class="btn btn-info">{{trans('lang::translation.CreateUser')}}</a>
			@endpath       
            </div>
        </div>
    </div>
</div>
@endsection
					
					
