@extends('layouts.admin.master.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<div class="content-header">
	  <h1>Edit Product</h1>
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

    					<form class="form-horizontal" action="{{ url('/' . $module . '/update/' . $product->id) }}" method="post" enctype="multipart/form-data">
								{{csrf_field()}}
    							<div class="box-body">
										<div class="form-group">
                      <label for="img" class="col-sm-2 control-label">Image</label>
                      <div class="col-sm-10">
                        <input type="file" id="input_product" class="validate" name="img">
												<img src="{{ url('img/products/'.$product->img) }}" id="show_product">
                      </div>
                    </div>
    								<div class="form-group">
    									<label for="first_name" class="col-sm-2 control-label">Name</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="name" value="{{ $product->name }}">
    									</div>
    								</div>
										<div class="form-group">
    									<label for="last_name" class="col-sm-2 control-label">Description</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="description" value="{{ $product->description }}">
    									</div>
    								</div>
    								<div class="form-group">
    									<label for="username" class="col-sm-2 control-label">Minimum Order</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="min_order" value="{{ $product->min_order }}">
    									</div>
    								</div>
    								<div class="form-group">
    									<label for="email" class="col-sm-2 control-label">Maximum Order</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="max_order" value="{{ $product->max_order }}">
    									</div>
    								</div>
                    <div class="form-group">
    									<label for="email" class="col-sm-2 control-label">Multiple</label>
    									<div class="col-sm-10">
    										<input type="text" class="form-control" name="multiple" value="{{ $product->multiple }}">
    									</div>
    								</div>
    							</div>
    							<!-- /.box-body -->
    							<div class="box-footer">
    								<button type="submit" class="btn btn-info pull-right">update</button>
    							</div>
    								<!-- /.box-footer -->
    					</form>
    				</div>

    </section>

    <!-- /.content -->
  </div>

@endsection
