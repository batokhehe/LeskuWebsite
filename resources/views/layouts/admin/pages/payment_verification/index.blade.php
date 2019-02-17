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
		          <h3 class="box-title">Data Table Payment Verification</h3>
		        </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped table-responsive" width="100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Product</th>
									<th>Ordered Assembly</th>
                  <th>Ordered Subject</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
									@php ($i = 1)
                  @foreach ($study_classes as $study_class)
                  <tr>
										<td>{{ $i }}</td>
                    <td>{{ $study_class->first_name . ' ' . $study_class->last_name }}</td>
                    <td>{{ $study_class->product_name }}</td>
                    <td>{{ $study_class->ordered_assembly }}</td>
                    <td>{{ $study_class->ordered_subject }}</td>
										<td><?php echo $study_class->status == '1' ? 'Pay' : 'Active' ?></td>
                    <td align="center">
											<a href="{{ url('/' . $module . '/edit/' . $study_class->id) }}" type="button" class="btn-sm btn-primary"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
											<a href="{{ url('/' . $module . '/delete/' . $study_class->id) }}" type="button" class="btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</a>
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
