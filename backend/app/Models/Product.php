<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $primaryKey = "id";
    public $incrementing = false;
    protected $table = "products";

    protected $fillable = ["name", "description", "producer_id"];

    // get author of company that owns this product
    public function get_author(): User
    {
        $company = $this->get_producer();
        return User::find($company->author_id);
    }

    // get company model
    public function get_producer(): Company
    {
        return Company::find($this->producer_id);
    }

    public function productMeta()
    {
        return $this->belongsToMany(ProductMeta::class, "product_meta", "product_id", "id");
    }

}