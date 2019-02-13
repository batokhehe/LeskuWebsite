@extends('layouts.admin.master.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<div class="content-header">
	  <h1>Activation Teacher</h1>
	</div>
    <!-- Main content -->
    <section class="content container-fluid">
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="box box-info">
    					<!-- /.box-header -->

    					<!-- form start -->
							@if(count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
									<li>{{$error}}</li>
									@endforeach
								</ul>
							</div>
							@endif
							@if(\Session::has('success'))
							<div class="alert alert-success">
								<p>{{\Session::get('success')}}</p>
							</div>
							@endif

    					<form class="form-horizontal" action="{{ url('/' . $module . '/update/' . $user->id) }}" method="post">
								{{csrf_field()}}
    							<div class="box-body">
    								<div class="form-group">
    									<label for="first_name" class="col-sm-2 control-label">First Name</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
    									</div>
    								</div>
										<div class="form-group">
    									<label for="last_name" class="col-sm-2 control-label">Last Name</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
    									</div>
    								</div>
    								<div class="form-group">
    									<label for="username" class="col-sm-2 control-label">Username</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="username" value="{{ $user->username }}">
    									</div>
    								</div>
    								<div class="form-group">
    									<label for="email" class="col-sm-2 control-label">E-mail</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="email" value="{{ $user->email }}">
    									</div>
    								</div>
    							</div>
    							<!-- /.box-body -->
    							<div class="box-footer">
    								<button type="submit" class="btn btn-info pull-right">Active</button>
    							</div>
    								<!-- /.box-footer -->
    					</form>
    				</div>

    </section>

    <!-- /.content -->
  </div>

@endsection
