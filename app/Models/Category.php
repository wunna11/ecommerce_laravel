<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // We want to insert all columns values
    protected $guarded = [];

    public function product()
    {
        return $this->hasMany(Category::class);
    }
}
