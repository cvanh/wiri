<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = "id";
    public $incrementing = false;
    protected $table = "companies";

    protected $fillable = ["type", "name", "about", "author_id"];
}