<?php

namespace App\Modules\MoneyManager\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MoneyManager\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('MoneyManager::category.index');
    }
}
