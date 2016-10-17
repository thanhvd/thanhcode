<?php

namespace App\Modules\MoneyManager\Repositories;

use App\Modules\MoneyManager\Models\Category;
use Auth;

class CategoryRepository
{
    public static function getTreeData($level = 0)
    {
        $data = [];

        $categories = Auth::user()->categories()->where('level', $level)->get();

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
        if ( count($children) > 0 ) {
            foreach ($children as $item) {
                $data[] = $item;
                $data = array_merge($data, self::getChildrenTreeData($item));
            }
        }
        return $data;
    }

    public static function getTreeData1($level = 0)
    {
        $data = [];

        $categories = Auth::user()->categories()->where('level', $level)->get();

        if ( count($categories) > 0 ) {
            foreach ($categories as $category) {
                $data[] = $category;
                $data = array_merge($data, self::getChildrenTreeData($category));
            }
        }
        return $data;
    }
}
