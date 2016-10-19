<?php

namespace App\Modules\MoneyManager\Repositories;

use App\Modules\MoneyManager\Models\Category;
use Auth;

class CategoryRepository
{
    const TOP_LEVEL = 0;

    public static function getTreeGridData()
    {
        return Auth::user()->categories()->select('id', 'name', 'avatar', 'parent_id AS _parentId', 'avatar AS iconCls')->get();
    }

    public static function getComboTreeData(Category $parentCategory = null)
    {
        if ($parentCategory) {
            $categories = $parentCategory->children()->select('id', 'name AS text')->get();
        } else {
            $categories = Auth::user()->categories()->select('id', 'name AS text')->where('level', self::TOP_LEVEL)->get();
        }

        if ( count($categories) > 0 ) {
            foreach ($categories as $k => $category) {
                $categories[$k]->children = self::getComboTreeData($category);
            }
        }

        return $categories;
    }
}
