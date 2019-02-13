@extends('layouts.admin.master.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<div class="content-header">
	  <h1>User</h1>
	</div>
    <!-- Main content -->
    <section class="content container-fluid">
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
		<div class="row">
        <div class="col-md-12">
          <div class="box">
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
						<div class="box-header">
		          <h3 class="box-title">Data Table Teacher</h3>
							<a href="/<?php echo $module ?>/create" type="button" class="btn btn-info pull-right">Create</a>
		        </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped table-responsive" width="100%">
                <thead align=center>
                <tr>
                  <th>No</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>User Name</th>
                  <th>E-mail</th>
									<th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
									@php ($i = 1)
                  @foreach ($users as $user)
                  <tr>
										<td>{{ $i }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
										<td><?php echo $user->status == '0' ? 'Non-Active' : 'Active' ?></td>
                    <td align="center">
											<a href="{{ url('/' . $module . '/edit/' . $user->id) }}" type="button" class="btn-sm btn-primary"><i class="fa fa-edit"></i>&nbsp;Activation</a> &nbsp;
											<a href="{{ url('/' . $module . '/delete/' . $user->id) }}" type="button" class="btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                  </tr>
									@php ($i++)
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

    </section>

    <!-- /.content -->
  </div>

@endsection
