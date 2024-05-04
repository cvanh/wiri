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

    // get author of producer that owns this product
    public function get_author(): User
    {
        $producer = $this->get_producer();
        return User::find($producer->author_id);
    }

    // get producer model
    public function get_producer(): Producer
    {
        return Producer::find($this->producer_id);
    }
}