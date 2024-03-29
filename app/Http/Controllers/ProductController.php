<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private function validateBrand($id)
    {

        $products = product::where('brand_id', $id)->get();

        if ($products->isEmpty()) {

            return false;
        }

        return true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(brand $brand)
    {

        $products = product::where('brand_id', $brand->id)->get();
        return view('products.index', compact('products', 'brand'));
    }

    public function indexApi(Request $request)
    {

        $data = $request->all();

        if (isset($data[0]['id'])) {

            $validateBrand = $this->validateBrand($data[0]['id']);

            if ($validateBrand) {

                $products = product::where('brand_id', $data[0]['id'])->get();
                return response()->json($products);
            }

            return response()->json(['status' => false, 'message' => 'Brand not found']);
        } else {

            return response()->json(['status' => false, 'message' => 'Brand not received']);
        }
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

    public function storeApi(Request $request)
    {
        $data = $request->all();

        if (
            isset($data[0]['brand_id']) &&
            isset($data[0]['product_name']) &&
            isset($data[0]['size']) &&
            isset($data[0]['inventory_quantity']) &&
            isset($data[0]['shipment_date']) &&
            isset($data[0]['observations'])
        ) {

            if (
                is_string($data[0]['product_name']) &&
                strlen($data[0]['product_name']) <= 30 &&
                in_array($data[0]['size'], ["S", "M", "L"]) &&
                intval($data[0]['inventory_quantity']) > 0 &&
                strtotime($data[0]['shipment_date']) < time() &&
                !empty($data[0]['observations'])
            ) {

                $brandExists = $this->validateBrand($data[0]['brand_id']);

                if ($brandExists) {

                    $product = Product::create([
                        'brand_id' => $data[0]['brand_id'],
                        'product_name' => $data[0]['product_name'],
                        'size' => $data[0]['size'],
                        'inventory_quantity' => $data[0]['inventory_quantity'],
                        'shipment_date' => $data[0]['shipment_date'],
                        'observations' => $data[0]['observations']
                    ]);

                    if ($product) {

                        return response()->json(['status' => true, 'message' => 'Brand created successfully'], 200);
                    } else {

                        return response()->json(['status' => false, 'message' => 'Failed to create brand'], 422);
                    }
                } else {

                    return response()->json(['status' => false, 'message' => 'Brand not found'], 422);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'Data incorrect'], 422);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Data not received'], 422);
        }
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

    public function updateApi(Request $request)
    {
        $data = $request->all();

        if (
            isset($data['brand_id']) &&
            isset($data['id']) &&
            isset($data['product_name']) &&
            isset($data['size']) &&
            isset($data['inventory_quantity']) &&
            isset($data['shipment_date']) &&
            isset($data['observations'])
        ) {

            if (
                is_string($data['product_name']) &&
                strlen($data['product_name']) <= 30 &&
                in_array($data['size'], ["S", "M", "L"]) &&
                intval($data['inventory_quantity']) > 0 &&
                strtotime($data['shipment_date']) < time() &&
                !empty($data['observations'])
            ) {
                $brandExists = $this->validateBrand($data['brand_id']);

                $product = Product::find($data['id']);

                if ($brandExists && $product) {

                    $product->product_name = $data['product_name'];
                    $product->size = $data['size'];
                    $product->inventory_quantity = $data['inventory_quantity'];
                    $product->shipment_date = $data['shipment_date'];
                    $product->observations = $data['observations'];

                    $product->save();

                    if ($product->wasChanged()) {

                        return response()->json(['status' => true, 'message' => 'Brand updated successfully'], 200);
                    } else {

                        return response()->json(['status' => false, 'message' => 'Brand data remains unchanged'], 422);
                    }
                } else {

                    return response()->json(['status' => false, 'message' => 'Product not found'], 422);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'Data incorrect'], 422);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Data not received'], 422);
        }
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


        if (!$product->delete()) {
            return false;
        }

        return true;
    }

    public function destroyApi(Request $request)
    {
        $data = $request->all();

        if (isset($data[0]['id']) && $data[0]['brand_id']) {

            $brandExists = $this->validateBrand($data[0]['brand_id']);

            $product = Product::find($data[0]['id']);


            if ($brandExists && $product) {

                $deleted = $product->delete();

                if ($deleted) {

                    $productExists = Brand::find($data[0]['id']);

                    if (!$productExists) {

                        return response()->json(['status' => true, 'message' => 'Product deleted successfully']);
                    } else {

                        return response()->json(['status' => false, 'message' => 'Product deletion failed']);
                    }
                } else {
                    return response()->json(['status' => false, 'message' => 'Failed to delete product']);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'Product not found']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Data not received']);
        }
    }
}