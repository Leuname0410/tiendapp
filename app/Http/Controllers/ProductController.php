<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(brand $brand)
    {

        $products = product::where('brand_id', $brand->id)->get();
        return view('products.index', compact('products','brand'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(brand $brand)
    {
        return view('products.create', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->brand_id = $request->input('brand_id');
        $product->product_name = $request->input('product_name');
        $product->size = $request->input('size');
        $product->inventory_quantity = $request->input('inventory_quantity');
        $product->shipment_date = $request->input('shipment_date');
        $product->observations = $request->input('observations');

        $product->save();
        return redirect()->route('products.index', $request->brand_id)->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        $product = Product::find($product->id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $product = Product::find($product->id);
        $product->brand_id = $product->brand_id;
        $product->product_name = $request->input('product_name');
        $product->product_name = $request->input('product_name');
        $product->size = $request->input('size');
        $product->inventory_quantity = $request->input('inventory_quantity');
        $product->shipment_date = $request->input('shipment_date');
        $product->observations = $request->input('observations');
        $product->save();

        return redirect()->route('products.index', $product->brand_id)->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product = Product::find($product->id);


        if(!$product->delete())
        {
            return false;
        }

        return true;
    }
}
