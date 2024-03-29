<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Producer::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "type" => "required|in:store,producer",
            "about" => "required|string"
        ]);
        $data = [
            "author_id" => Auth::user()->id,
            "name" => $request->name,
            "type" => $request->type,
            "about" => $request->about
        ];

        Producer::create($data);

        return response(status: 201);
    }

    /**
     * Display the specified resource.
     * @response {
     * "author_id": "6151770A-5AD7-458E-B79B-5A417046ABE5",
     * "type": "store",
     * "about": "the shop is created in 2019" 
     * }
     * @authenticated
     */
    public function show(string $id)
    {
        return Producer::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}