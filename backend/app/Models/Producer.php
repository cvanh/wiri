<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model 
{
    use HasFactory, HasUuids;
    protected $primaryKey = "id";
    public $incrementing = false;
    protected $table = "producers";

    protected $fillable = ["type", "name", "about"];
}