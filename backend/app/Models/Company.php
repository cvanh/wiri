<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class Company extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $table = 'companies';

    protected $fillable = ['type', 'longitude', 'latitude', 'name', 'about', 'author_id'];

    public function reviews(): MorphMany
    {
        return $this->morphMany(Reviews::class, 'review');
    }
}
