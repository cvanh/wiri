<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @authenticated
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     * @authenticaed
     */
    public function store(StoreProductRequest $request)
    {
        $data = [
            "name" => $request->name,
            "description" => $request->description,
            "producer_id" => $request->producer_id
        ];
        Product::create($data);

        return  Response(status: 201);
    }

    /**
     * Display the specified resource.
     * @authenticated
     */
    public function show($id)
    {
        // TODO make return object
        return Product::findOrFail($id)->first()->get();
    }

    /**
     * Update the specified resource in storage.
     * @authenticated
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product = Product::findOrFail($request->id);

        if (!Gate::authorize("update", $product)) {
            abort(403);
        }

        return $product->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     * @authenticated
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (!Gate::authorize("delete", $product)) {
            abort(403);
        }

        return Product::destroy($id);

        
    }
}