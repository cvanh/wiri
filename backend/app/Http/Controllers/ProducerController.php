<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @authenticated
     */
    public function index()
    {
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     * @authenticated
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "type" => "required|in:store,company",
            "about" => "required|string"
        ]);
        $data = [
            "author_id" => Auth::user()->id,
            "name" => $request->name,
            "type" => $request->type,
            "about" => $request->about
        ];

        Company::create($data);

        return response(status: 201);
    }

    /**
     * Display the specified resource.
     * @authenticated
     */
    public function show(string $id)
    {
        return Company::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     * @authenticated
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @authenticated
     */
    public function destroy(string $id)
    {
        //
    }
}