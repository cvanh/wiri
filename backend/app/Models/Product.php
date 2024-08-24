<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Product extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $table = 'products';

    protected $fillable = ['name', 'description', 'producer_id'];

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

    public function reviews(): MorphMany
    {
        return $this->morphMany(Reviews::class, 'review');
    }
}
