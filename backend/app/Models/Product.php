<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = "id";
    public $incrementing = false;
    protected $table = "products";

    protected $fillable = ["name", "description", "producer_id"];
}