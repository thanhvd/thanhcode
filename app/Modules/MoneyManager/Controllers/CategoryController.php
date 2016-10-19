<?php

namespace App\Modules\MoneyManager\Controllers;

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
        $categories = CategoryRepository::getTreeGridData();

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
        $categories = CategoryRepository::getComboTreeData();

        return view('MoneyManager::category.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Modules\MoneyManager\Requests\StoreCategory  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
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
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = CategoryRepository::getTreeGridData();

        return view('MoneyManager::category.edit', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Modules\MoneyManager\Requests\UpdateCategory  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, Category $category)
    {
        // Save category
        $category->name = $request->name;
        // Check avatar uploaded?
        if ($request->hasFile('avatar')) {
            $storePath = config('money_manager.category.avatar_storage_path') . '/' . $request->user()->id;
            // Delete old avatar file
            // if ($category->avatar && Storage::disk('public')->exists($category->avatar)) {
            //     Storage::disk('public')->delete($category->avatar);
            // }
            // Store new avatar file
            $avatar = $request->file('avatar')->store($storePath, 'public');
            $category->avatar = $avatar;
        }
        // Check parent selected?
        if ($request->parent_id) {
            $parent = Category::find($request->parent_id);

            $category->parent_id = $parent->id;
            $category->level = ++$parent->level;
        }
        $category->save();
        $request->session()->flash('message', trans('MoneyManager::category.edit.success'));

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ( count($category->children) == 0 ) {
            // TODO: Delete payments of this category
            $category->delete();

            Session::flash('message', trans('MoneyManager::category.delete.success'));
        } else {
            Session::flash('message', trans('MoneyManager::category.delete.children_exists'));
        }

        return redirect()->route('categories.index');
    }

    public function getTreeGridData()
    {
        $categories = CategoryRepository::getTreeGridData();

        return response()->json([
            'total' => count($categories),
            'rows' => $categories
        ]);
    }

    public function getComboTreeData()
    {
        // Default value
        $defaultValue = [ 'id' => '', 'text' => trans('MoneyManager::category.create.labels.select_parent') ];

        $categories = CategoryRepository::getComboTreeData();

        $categories->prepend($defaultValue);

        return response()->json($categories);
    }
}
