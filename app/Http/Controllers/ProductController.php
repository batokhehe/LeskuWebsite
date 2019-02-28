<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Validator;

class ProductController extends Controller
{
  private $module = 'product';

    public function index()
    {
      $products = new Product;

      $data = $products->getAll();
      return view('layouts.admin.pages.product.index')
              ->with('products', $data)
              ->with('module', $this->module);
    }

    public function create()
    {
      return view('layouts.admin.pages.product.create');
    }

    public function store(Request $request)
    {

      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'description' => 'required',
        'image' => 'required',
        'min_order' => 'required',
        'max_order' => 'required',
        'multiple' => 'required',
        'price' => 'required'
      ]);

      if ($validator->fails()) {
          return redirect('product/create')
                      ->withErrors($validator)
                      ->withInput();
      }

        $image           = $request->file('image');
        $image_product   = $image->getClientOriginalName();
        $request->file('image')->move("img/products", $image_product);


      $products = new Product([
        'name' => $request->post('name'),
        'description' => $request->post('description'),
        'image' => $image_product,
        'min_order' => $request->post('min_order'),
        'max_order' => $request->post('max_order'),
        'multiple' => $request->post('multiple'),
        'price' => $request->post('price')
      ]);
      if($products->save()){
        return redirect('product')->with('success', 'Data Added');
      } else {
        return redirect('product/create')->with('danger', 'Data Failed to Add');
      }
    }
    public function show()
    {

    }

    public function edit($id)
    {
      $products = new Product;

      $data = $products->find($id);

      return view('layouts.admin.pages.product.edit')
                ->with('product', $data)
                ->with('module', $this->module);
    }

    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'description' => 'required',
        'image' => 'required',
        'min_order' => 'required',
        'max_order' => 'required',
        'multiple' => 'required',
        'price' => 'required'
      ]);

      if ($validator->fails()) {
          return redirect($this->module . '/edit/' . $id)
                      ->withErrors($validator)
                      ->withInput();
      }

      $image           = $request->file('img');
      $image_product   = $image->getClientOriginalName();
      $request->file('img')->move("img/products", $image_product);

      $products = new Product;
      $data = array(
        'name' => $request->post('name'),
        'description' => $request->post('description'),
        'min_order' => $request->post('min_order'),
        'max_order' => $request->post('max_order'),
        'multiple' => $request->post('multiple'),
        'price' => $request->post('price')
      );

      $data = $products->update($data, $id);

      return redirect('product')
              ->with('success', 'Data Updated')
              ->with('module', $this->module);
    }

    public function delete($id)
    {
      $products = new Product;

      $data = array(
        'deleted_at' => now(),
      );

      $result = $products->softDelete($data, $id);

      if($result){
        return redirect('product')
                ->with('success', 'Data Deleted')
                ->with('module', $this->module);
      }
    }
}
