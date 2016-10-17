<?php

namespace App\Modules\Api\MoneyManager\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MoneyManager\Models\Category;
use App\Modules\MoneyManager\Repositories\CategoryRepository;
use App\Modules\MoneyManager\Requests\StoreCategory;
use App\Modules\MoneyManager\Requests\UpdateCategory;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(Auth::user());
        $categories = CategoryRepository::getTreeData();

        return response()->json([
            'categories' => $categories
        ]);
    }
}
