<?php

namespace Akhaled\Like4Card\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Akhaled\Like4Card\Database\Factories\CategoryFactory;

class Category extends Model
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
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
