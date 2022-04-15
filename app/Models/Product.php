<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // We want to insert all columns values
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
