<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \App\Models\Product
   */
  public function index()
  {
    return Product::orderBy('id', 'desc')->get();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \App\Models\Product
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|max:100',
      'description' => 'required',
      'price' => 'required|numeric|between:0.99,999999999.99',
    ]);

    return Product::create($request->all());
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Product $product
   * @return \App\Models\Product
   */
  public function show($id)
  {
    $product = Product::where('id', $id)->first();
    if ($product) {
      return $product;
    } else {
      return response([
        'message' => 'No Products with this id'
      ], 404);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \App\Models\Product
   */
  public function update(Request $request, $id)
  {
    $product = Product::find($id);
    $product->update($request->all());
    return $product;
  }

  /**
   * Destroy the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return boolean
   */
  public function destroy(Request $request, $id)
  {
    if (Product::destroy($id)) {
      return response(['message' => 'Product deleted successfully']);
    } else {
      return response([
        'error' => true,
        'message' => 'No product with this id'
      ]);
    }
  }

  /**
   * Search for a name.
   *
   * @param string $name
   * @return \App\Models\Product
   */
  public function search($name)
  {
    return Product::where('name', 'like', '%' . $name . '%')->get();
  }
}
