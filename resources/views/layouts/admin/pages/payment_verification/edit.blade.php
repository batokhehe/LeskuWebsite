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
										<th width="30%">Student Name</th>
										<td>: {{ $header->first_name . ' ' . $header->last_name }}</td>
									</tr>
									<tr>
										<th width="30%">Product Name</th>
										<td>: {{ $header->product_name }}</td>
									</tr>
								</table>
							</div>

              <table class="table table-bordered table-striped table-responsive" width="100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Teacher Name</th>
                  <th>Subject Name</th>
									<th>Study Start At</th>
                </tr>
                </thead>
                <tbody>
									@php ($i = 1)
                  @foreach ($details as $detail)
                  <tr>
										<td>{{ $i }}</td>
                    <td>{{ $detail->teacher_name }}</td>
                    <td>{{ $detail->subject_name }}</td>
										<td>{{ $detail->study_start_at }}</td>
                  </tr>
									@php ($i++)
                  @endforeach
                </tbody>
              </table>
							<div class="box-footer">
								<button type="submit" class="btn btn-info pull-right">Update</button>
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
