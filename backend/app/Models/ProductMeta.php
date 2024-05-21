<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductMeta extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $primaryKey = "id";
    public $incrementing = false;
    protected $table = "product_meta";

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}