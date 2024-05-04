<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
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
     */
    public function show($id)
    {
        // TODO make return object
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->get_author()->id === Auth::User()->id) {
            return Product::destroy($id);
        }

        return Response(status: AccessDeniedException);
        
    }
}