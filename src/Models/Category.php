<?php

namespace Akhaled\Like4Card\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Akhaled\Like4Card\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }
}
