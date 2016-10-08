<?php

namespace App\Modules\MoneyManager\Models;

use App\Modules\MoneyManager\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'mm_payments';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'paid_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
