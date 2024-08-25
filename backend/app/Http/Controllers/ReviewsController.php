<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = Relation::getMorphedModel(
            request()->route()->parameter("model")
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        return $this->model::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer'
        ]);

        $data = [
            'content' => $request->content,
            'rating' => $request->rating,
            'author_id' => Auth::user()->id,
        ];

        $parent_model = $this->model::where('id', $request->model_id)->first();
        $parent_model->reviews()->create($data);

        return response(status: 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $model, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($model, string $id)
    {
        //
    }
}
