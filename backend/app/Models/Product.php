<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductMeta;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function productMeta(): HasMany 
    {
        return $this->hasMany(ProductMeta::class);
    }

}