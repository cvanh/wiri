<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     * @authenticated
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @authenticated
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->get_author()->id === Auth::User()->id) {
            return Product::destroy($id);
        }

        return Response(status: 204);
        
    }
}