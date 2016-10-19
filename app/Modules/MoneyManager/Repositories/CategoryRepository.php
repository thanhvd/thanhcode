<?php

namespace App\Modules\MoneyManager\Repositories;

use App\Modules\MoneyManager\Models\Category;
use Auth;

class CategoryRepository
{
    const TOP_LEVEL = 0;

    public static function getTreeGridData()
    {
        return Auth::user()->categories()->select('id', 'name', 'avatar', 'parent_id AS _parentId')->get();
    }

    public static function getComboTreeData(Category $parentCategory = null, $selectedCategory = null)
    {
        // dd($selectedCategory);
        if ($parentCategory) {
            $categories = $parentCategory->children()->select('id', 'name AS text', 'avatar')->get();
        } else {
            $categories = Auth::user()->categories()->select('id', 'name AS text', 'avatar')->where('level', self::TOP_LEVEL)->get();
        }

        if ( count($categories) > 0 ) {
            foreach ($categories as $k => $category) {
                if ( $selectedCategory && $selectedCategory->id == $category->id ) {
                    $categories[$k]->checked = true;
                    $categories[$k]->selected = true;
                }
                $categories[$k]->children = self::getComboTreeData($category, $selectedCategory);
            }
        }

        return $categories;
    }
}
