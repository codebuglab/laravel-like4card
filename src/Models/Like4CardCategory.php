<?php

namespace Akhaled\Like4Card\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Akhaled\Like4Card\Models\Like4CardProduct as Product;
use Akhaled\Like4Card\Database\Factories\Like4CardCategoryFactory as CategoryFactory;

class Like4CardCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    public function children()
    {
        return $this->hasMany(Like4CardCategory::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
