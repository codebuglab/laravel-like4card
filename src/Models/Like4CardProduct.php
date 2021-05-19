<?php

namespace CodeBugLab\Like4Card\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use CodeBugLab\Like4Card\Database\Factories\Like4CardProductFactory as ProductFactory;
use CodeBugLab\Like4Card\Models\Like4CardCategory as Category;

class Like4CardProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'like4_card_category_id');
    }
}
