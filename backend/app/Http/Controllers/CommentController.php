<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
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
    public function store(Request $request, $model, $model_id)
    {
        //
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
