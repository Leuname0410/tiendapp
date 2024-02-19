<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all()->sortBy('id');
        return view('brands.index', compact('brands'));
    }

    public function indexApi()
    {
        $brands = Brand::all()->sortBy('id');
        return response()->json($brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands|max:50',
        ]);

        Brand::create($request->all());

        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    public function storeApi(Request $request)
    {
        $data = $request->all();

        if (
            isset($data[0]['name']) &&
            is_string($data[0]['name']) &&
            !empty($data[0]['name']) &&
            strlen($data[0]['name']) <= 50
        ) {

            $brand = Brand::create(['name' => $data[0]['name']]);

            if ($brand) {

                return response()->json(['status' => false, 'message' => 'Brand created successfully'], 200);
            } else {

                return response()->json(['status' => false, 'message' => 'Failed to create brand'], 422);
            }
        } else {

            return response()->json(['status' => false, 'message' => 'Name not received'], 422);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, brand $brand)
    {
        $request->validate([
            'name' => 'required|unique:brands|max:50',
        ]);

        $brand->update($request->all());

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    public function updateApi(Request $request)
    {

        $data = $request->all();

        if (
            isset($data[0]['name']) &&
            isset($data[0]['id']) &&
            is_string($data[0]['name']) &&
            !empty($data[0]['name']) &&
            strlen($data[0]['name']) <= 50
        ) {

            $brand = Brand::find($data[0]['id']);

            if ($brand) {

                $brand->name = $data[0]['name'];
                $brand->save();

                if ($brand->wasChanged()) {
                    return response()->json(['status' => true, 'message' => 'Brand updated successfully'], 200);
                } else {
                    return response()->json(['status' => false, 'message' => 'Brand data remains unchanged'], 422);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'Brand not found'], 422);
            }
        } else {

            return response()->json(['status' => false, 'message' => 'Data not received'], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(brand $brand)
    {
        if (!$brand->delete()) {
            return false;
        }

        return true;
    }

    public function destroyApi(Request $request)
    {
        $data = $request->all();

        if (isset($data[0]['id'])) {

            $brand = Brand::find($data[0]['id']);

            if ($brand) {

                $deleted = $brand->delete();

                if ($deleted) {

                    $brandExists = Brand::find($data[0]['id']);

                    if (!$brandExists) {
                        return response()->json(['status' => true, 'message' => 'Brand deleted successfully'], 200);
                    } else {
                        return response()->json(['status' => false, 'message' => 'Brand deletion failed'], 422);
                    }
                } else {
                    return response()->json(['status' => false, 'message' => 'Failed to delete brand'], 422);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'Brand not found'], 422);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'ID not received'], 422);
        }
    }
}