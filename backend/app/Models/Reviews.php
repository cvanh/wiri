<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviews extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $table = 'reviews';

    protected $fillable = ['content'];

    public function review(): MorphTo
    {
        return $this->morphTo();
    }
}
