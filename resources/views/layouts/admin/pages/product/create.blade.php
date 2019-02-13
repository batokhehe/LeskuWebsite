@extends('layouts.admin.master.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<div class="content-header">
	  <h1>Create Product</h1>
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
    					<form class="form-horizontal" action="{{ url('/product/store') }}" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}
									<div class="box-body">
                    <div class="form-group">
                      <label for="img" class="col-sm-2 control-label">Image</label>
                      <div class="col-sm-10">
                        <input type="file" id="input_product" class="validate" name="image">
                        <img id="show_product">
                      </div>
                    </div>
    								<div class="form-group">
    									<label for="nama" class="col-sm-2 control-label">Product Name</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="name" placeholder="Nama">
    									</div>
    								</div>
    								<div class="form-group">
    									<label for="Description" class="col-sm-2 control-label">Description</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="description" placeholder="Description">
    									</div>
    								</div>
    								<div class="form-group">
    									<label for="min_order" class="col-sm-2 control-label">Minimal Order</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="min_order" placeholder="Minimal Order">
    									</div>
    								</div>
    								<div class="form-group">
    								  <label for="max_order" class="col-sm-2 control-label">Maximal Order</label>
    								  <div class="col-sm-10">
    									<input type="text" class="form-control" name="max_order" placeholder="Maximal Order">
    								  </div>
    								</div>
    								<div class="form-group">
    								  <label for="multiple" class="col-sm-2 control-label">Multiple</label>
    								  <div class="col-sm-10">
    									<input type="text" class="form-control" name="multiple" placeholder="Multiple">
    								  </div>
    								</div>
    							<!-- /.box-body -->
    							<div class="box-footer">
    								<button type="submit" class="btn btn-info pull-right">Save</button>
    							</div>
    								<!-- /.box-footer -->
    					</form>
    				</div>

    </section>

    <!-- /.content -->
  </div>

@endsection
