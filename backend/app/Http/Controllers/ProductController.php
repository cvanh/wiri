<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;

final class ProductController extends Controller
{
    /**
     * Display a listing of the resource. doesnt show product meta
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
            'name' => $request->name,
            'description' => $request->description,
            'producer_id' => $request->producer_id,
        ];
        $product = Product::create($data);

        // meta data is all extra data related to a product
        if (is_array($request->meta)) {
            $product->productMeta()->createMany($request->get('meta'));
        }

        return Response(status: 201);
    }

    /**
     * Display the specified resource.
     * @authenticated
     */
    public function show($id)
    {
        return Product::with('productMeta')->find($id);
    }

    /**
     * Update the specified resource in storage.
     * @authenticated
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product = Product::findOrFail($request->id);

        if (!Gate::authorize('update', $product)) {
            abort(403);
        }

        // TODO add product meta that can be edited

        $productUpdate = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        $product->update($productUpdate);

        if (is_array($request->meta)) {
            $product->productMeta()->updateMany($request->meta);
        }

        return Response(status: 200);
    }

    /**
     * Remove the specified resource from storage.
     * @authenticated
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (!Gate::authorize('delete', $product)) {
            abort(403);
        }

        $product->productMeta()->delete();
        return Product::destroy($id);
    }
}
