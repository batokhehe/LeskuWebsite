@extends('layouts.admin.master.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<div class="content-header">
	  <h1>Product</h1>
	</div>
    <!-- Main content -->
    <section class="content container-fluid">
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
		<div class="row">
        <div class="col-md-12">
          <div class="box">
						<div class="box-header">
		          <h3 class="box-title">Data Table Product</h3>
							<a href="/product/create" type="button" class="btn btn-info pull-right">Create</a>
		        </div>
            <!-- /.box-header -->
            <div class="box-body">

							<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Product Name</th>
                  <th>Description</th>
                  <th>Minimal Order</th>
                  <th>Maximal Order</th>
									<th>Multiple</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
									@php ($i = 1)
                  @foreach ($products as $product)
                  <tr>
										<td>{{ $i }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->min_order }}</td>
                    <td>{{ $product->max_order }}</td>
										<td>{{ $product->multiple }}</td>
										<td align="center">
											<a href="{{ url('/' . $module . '/edit/' . $product->id) }}" type="button" class="btn-sm btn-success">Edit</a>
											<a href="{{ url('/' . $module . '/delete/' . $product->id) }}" type="button" class="btn-sm btn-danger">Delete</a>
										</td>
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
