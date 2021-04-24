@extends('layouts.app')
@section('content')

<div class="container">
@include('rolespermissions.header')
    <div class="panel panel-default">
        <div class="panel-heading"><h1>{{trans('lang::translation.CreateRole')}}</h1></div>
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
				
                    
				<form action="{{ route('roles.store')}}" method="post">
					<input name="_token" type="hidden" value="{{ csrf_token() }}">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">
							<span class="h4">
								{{trans('lang::translation.Name')}}:
							</span>
						</label>
						<div class="col-sm-5">
							<input type="text" name="name" class="form-control" />
						</div>
					</div>
					<div class="form-check row">
						<div class="col-sm-3"> 
							<input type="checkbox" name="is_active" class="form-check-input" value="1" />
							<label class="col-form-label">
								<span class="h4">
									{{trans('lang::translation.isActive')}}
								</span>
							</label>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">
							<span class="h4">
								{{trans('lang::translation.Routes')}}:
							</span>
						</label>
					</div>	
					@foreach($permissions as $permission)
					<div class="form-check row offset-sm-1">
						<div class="col-sm-3"> 
							<input type="checkbox" name="routes[]" class="form-check-input" value="{{$permission->id}}"/>
							<label class="form-check-label">
								<span class="h4">
									{{$permission->name}}
								</span>
							</label>
						</div>							
					</div>
					@endforeach	
					<div class="form-group">
						<div class="offset-sm-4 col-sm-5">
							<input type="submit" value="{{trans('lang::translation.Save')}}" class="btn btn-primary" />
						</div>
					</div>
                   </form>
			</div>
        </div>
    </div>
</div>
@endsection
