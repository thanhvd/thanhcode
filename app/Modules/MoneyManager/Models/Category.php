<?php

namespace App\Modules\MoneyManager\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'mm_categories';

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
