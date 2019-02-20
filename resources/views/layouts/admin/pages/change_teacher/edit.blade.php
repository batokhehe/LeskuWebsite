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
			<form class="form-horizontal" action="{{ url('/' . $module . '/update/' . $header->id) }}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
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
		          <h3 class="box-title">Data Table Detail</h3>
		        </div>
            <!-- /.box-header -->
            <div class="box-body">

				<div class="col-md-12">
					<table class="table table-responsive" width="100%">
						<tr>
							<th width="30%">Student</th>
							<td>: &nbsp; {{ $header->first_name . ' ' . $header->last_name }}</td>
						</tr>
						<tr>
							<th>Teacher</th>
							<td>: &nbsp; {{ $header->teacher_name }}</td>
						</tr>
						<tr>
							<th>Subject</th>
							<td>: &nbsp; {{ $header->subject_name }}</td>
						</tr>
						<tr>
							<th>Study Start At</th>
							<td>: &nbsp; {{ $header->study_start_at }}</td>
						</tr>
					</table>
				</div>

              <table id="example1" class="table table-bordered table-striped table-responsive" width="100%">
                <thead>
                <tr>
                	<th></th>
                  	<th>Teacher</th>
                  	<th>Age</th>
                  	<th>Address</th>
                  	<th>Study</th>
                  	<th>Rating</th>
					<th>Action</th>
                </tr>
                </thead>
                <tbody>
                	@foreach ($details as $detail)
                	<tr>
	                	<td align="center"><img src="{{ url('/img/teacher_profile/' . $detail->image) }}" width="100px"></td>
	                    <td>{{ $detail->name }}</td>
	                    <td>{{ $detail->age }}</td>
	                    <td>{{ $detail->address }}</td>
	                    <td>{{ $detail->graduated . ' ' . $detail->major }}</td>
	                    <td>{{ 0 }}</td>
	                    <td><input type="radio" name="teacher" value="{{ $detail->teacher_id }}"></td>
	                </tr>
                  	@endforeach
                </tbody>
              </table>
							<div class="box-footer">
								<a href="{{ url('/' . $module) }}" class="btn btn-default pull-left"><i class="fa fa-left-arrow"></i> &nbsp; Back</a>
								<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> &nbsp; Update</button>
							</div>
								<!-- /.box-footer -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
				</form>
      </div>

    </section>

    <!-- /.content -->
  </div>

@endsection
