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
							<th>Student Status</th>
							<td>: &nbsp; <?php if($header->student_status == '5'){ 
                                echo 'Reschedule'; 
                              } else if ($header->student_status == '4') {
                                echo 'Dikonfirmasi';
                              } else { echo 'Belum Dikonfirmasi'; } ?></td>
						</tr>
						<tr>
							<th>Student Phone Number</th>
							<td>: &nbsp; {{ $header->student_phone }}</td>
						</tr>
						<tr>
							<th>Teacher</th>
							<td>: &nbsp; {{ $header->teacher_name }}</td>
						</tr>
						<tr>
							<th>Teacher Status</th>
							<td>: &nbsp; <?php if($header->status == '5'){ 
                                echo 'Reschedule'; 
                              } else if ($header->status == '4') {
                                echo 'Dikonfirmasi';
                              } else { echo 'Belum Dikonfirmasi'; } ?></td>
						</tr>
						<tr>
							<th>Teacher Phone Number</th>
							<td>: &nbsp; {{ $header->teacher_phone }}</td>
						</tr>
						<tr>
							<th>Subject</th>
							<td>: &nbsp; {{ $header->subject_name }}</td>
						</tr>
						<tr>
							<th>Study Start At</th>
							<td>: &nbsp; {{ $header->study_start_at }}</td>
						</tr>
						<tr>
							<th>New Schedule</th>
							<td>
								<select name="new_schedule" class="form-control select2">
									@foreach ($details as $detail)
									<option value="{{ $detail->id }}">{{ $detail->schedule_date }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<th>Alasan</th>
							<td><input type="text" name="reason" class="form-control"></td>
						</tr>
						<tr>
							<th>Pemohon</th>
							<td><input type="text" name="submitter" class="form-control"></td>
						</tr>
					</table>
				</div>
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
