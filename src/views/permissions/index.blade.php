@extends('layouts.app')

@section('content')
<div class="container">
@include('rolespermissions.header')
    <div class="panel panel-default">
        <div class="panel-heading">{{trans('lang::translation.Routes')}} </div>
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
					  <th scope="col">{{trans('lang::translation.Method')}}</th>
					  <th scope="col">{{trans('lang::translation.Name')}}</th>
					  <th scope="col">{{trans('lang::translation.Path')}}</th>
					</tr>
				  </thead>
				  <tbody>
					@foreach($permissions as $permission)
					<tr> 
						<td>{{$permission->id}}</td>
						<td>{{$permission->method}}</td>
						<td>{{$permission->name}}</td>
						<td>{{$permission->route}}</td>
						<td>
						@path('permissions.edit')
							<a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-warning"> {{trans('lang::translation.Edit')}}</a>
						@endpath
						@path('permissions.destroy')
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$permission->id}}">
								{{trans('lang::translation.Delete')}}
							</button>
						<!-- Modal -->
						<div class="modal fade" id="deleteModal-{{$permission->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">{{trans('lang::translation.ConfirmDelete')}}</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
								<form action="{{ route('permissions.destroy', $permission->id)}}" method="post">
									@method('DELETE')
									<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
									{{trans('lang::translation.Do you really want to delete')}} <b>{{$permission->name}}</b>?
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
			@path('permissions.create')
				<a href="{{route('permissions.create')}}" class="btn btn-info">{{trans('lang::translation.CreatePermission')}}</a>
			@endpath
            </div>
        </div>
    </div>
</div>
@endsection
					
					
