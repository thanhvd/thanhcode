<?php

namespace App\Modules\MoneyManager\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MoneyManager\Requests\StoreMoneyManagerCategory;
use App\Modules\MoneyManager\Models\Category;
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
        $categories = Category::all();

        return view('MoneyManager::category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('MoneyManager::category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMoneyManagerCategory $request)
    {
        try {
            // Save category
            $category = new Category;
            $category->name = $request->name;
            // Check avatar uploaded?
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar')->store(
                    config('money_manager.category.avatar_storage_path') . '/' . $request->user()->id
                );
                $category->avatar = $avatar;
            }
            $category->save();
            // redirect
            session()->put('message', 'Successfully created nerd!');
            return redirect()->route('categories.index');
        } catch(Exception $e) {

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
