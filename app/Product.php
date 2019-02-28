<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'image', 'description', 'min_order', 'max_order', 'multiple', 'price',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function getAll()
    {
      $products = Product::whereNull('deleted_at')->get();
      return $products;
    }

    public function find($id)
    {
      $products = Product::where('id', $id)->first();
      return $products;
    }

    public function update($data = array(), $id = NULL)
    {
      $products = Product::where('id', $id)->update($data);
      return $products;
    }

    public function softDelete($data = array(), $id = NULL)
    {
      $products = Product::where('id', $id)->update($data);
      return $products;
    }
  }
