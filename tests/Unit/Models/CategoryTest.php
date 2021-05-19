<?php

namespace Akhaled\Like4Card\Tests\Unit\Models;

use Akhaled\Like4Card\Tests\TestCase;
use Akhaled\Like4Card\Models\Like4CardProduct as Product;
use Akhaled\Like4Card\Models\Like4CardCategory as Category;

class CategoryTest extends TestCase
{
    public function test_it_gets_parent_categories_only()
    {
        $parent_categories_count = 5;

        Category::factory()
            ->count($parent_categories_count)
            ->create()
            ->each(function (Category $category) {
                Category::factory()
                    ->count(2)
                    ->create(['parent_id' => $category->id]);
            });

        $this->assertCount($parent_categories_count, Category::parents()->get());
    }

    public function test_it_gets_sub_categories()
    {
        $categories = Category::factory()
            ->count(2)
            ->create()
            ->each(function (Category $category, int $index) {
                Category::factory()
                    ->count($index + 3)
                    ->create(['parent_id' => $category->id]);
            });

        $this->assertCount(
            3,
            Category::find(
                $categories->first()->id
            )
                ->children()
                ->get()
        );
    }

    public function test_it_gets_category_products()
    {
        $categories = Category::factory()
            ->count(2)
            ->create()
            ->each(function (Category $category) {
                Product::factory()
                    ->count(5)
                    ->create(['like4_card_category_id' => $category->id]);
            });

        $this->assertEquals(
            5,
            Category::find($categories->first()->id)
                ->products
                ->count()
        );
    }
}
