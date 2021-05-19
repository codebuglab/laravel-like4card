<?php

namespace CodeBugLab\Like4Card\Tests\Unit\Models;

use CodeBugLab\Like4Card\Tests\TestCase;
use CodeBugLab\Like4Card\Models\Like4CardProduct as Product;
use CodeBugLab\Like4Card\Models\Like4CardCategory as Category;

class ProductTest extends TestCase
{
    public function test_it_gets_category_from_product()
    {
        $categories = Category::factory()
            ->count(2)
            ->create()
            ->each(function (Category $category) {
                Product::factory()
                    ->count(5)
                    ->create(['like4_card_category_id' => $category->id]);
            });

        $category = $categories->first();
        $first_product = $category->products()->first();

        $this->assertEquals(
            Product::find($first_product->id)->first()->category->id,
            $category->id
        );
    }
}
