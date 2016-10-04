<?php

namespace App\Modules\MoneyManager\Repositories;

use App\Modules\MoneyManager\Models\Category;

class CategoryRepository
{
    public static function getTreeData(int $level = 0, Category $excludeChildren = null)
    {
        $data = [];
        $categories = Category::where('level', $level)->get();

        if ( count($categories) > 0 ) {
            foreach ($categories as $category) {
                $data[] = $category;
                $data = array_merge($data, self::getChildrenTreeData($category));
            }
        }
        return $data;
    }

    public static function getChildrenTreeData(Category $category)
    {
        $data = [];
        $children = $category->children;
        if ( count($children) > 0  ) {
            foreach ($children as $item) {
                $data[] = $item;
                $data = array_merge($data, self::getChildrenTreeData($item));
            }
        }
        return $data;
    }
}
