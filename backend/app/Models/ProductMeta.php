<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class ProductMeta extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $table = 'product_meta';

    protected $fillable = [
        'meta_key',
        'meta_value',
    ];

    // we hide the dates because it doesnt concern the user when shit happend
    protected $hidden = [
        'deleted_at',
        'updated_at',
        'created_at',
        'product_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
