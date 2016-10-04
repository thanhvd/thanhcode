<?php

namespace App\Modules\MoneyManager\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MoneyManager\Models\Category;
use App\Modules\MoneyManager\Repositories\CategoryRepository;
use App\Modules\MoneyManager\Requests\StoreMoneyManagerCategory;
use Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryRepository::getTreeData();

        return view('MoneyManager::category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryRepository::getTreeData();

        return view('MoneyManager::category.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMoneyManagerCategory $request)
    {
        // Save category
        $category = new Category;
        $category->user_id = Auth::user()->id;
        $category->name = $request->name;
        // Check avatar uploaded?
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store(
                config('money_manager.category.avatar_storage_path') . '/' . $request->user()->id,
                'public'
            );
            $category->avatar = $avatar;
        }
        // Check parent selected?
        if ($request->parent_id) {
            $parent = Category::find($request->parent_id);

            $category->parent_id = $parent->id;
            $category->level = ++$parent->level;
        }
        $category->save();
        $request->session()->flash('message', trans('MoneyManager::category.create.success'));

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = CategoryRepository::getTreeData();

        return view('MoneyManager::category.edit', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
