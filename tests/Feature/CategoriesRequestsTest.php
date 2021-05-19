<?php

namespace Akhaled\Like4Card\Tests\Feature;

use Akhaled\Like4Card\Models\Category;
use Akhaled\Like4Card\Tests\TestCase;

class CategoriesRequestsTest extends TestCase
{
    public function test_it_adds_can_add_new_category_to_database_from_api()
    {
        $categories = $this->like4Card::categories();

        $this->assertCount(1, $categories->data);

        $category = $categories->data[0];

        Category::create([
            'name' => $category->categoryName,
            'image' => $category->amazonImage
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => $category->categoryName
        ]);
    }

    public function test_it_adds_can_add_new_category_related_to_other_category_to_database_from_api()
    {
        $parent_category = Category::factory()->create();

        $categories = $this->like4Card::categories();

        $this->assertCount(1, $categories->data);

        $category = $categories->data[0];

        Category::create([
            'name' => $category->categoryName,
            'image' => $category->amazonImage,
            'parent_id' => $parent_category->id
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => $category->categoryName,
            'parent_id' => $parent_category->id
        ]);
    }
}