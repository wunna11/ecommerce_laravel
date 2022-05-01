<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function categories()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.categories', compact('categories'))->with('no', 1);
    }

    public function add()
    {
        return view('admin.category.add_category');
    }

    public function save(saveCategoryRequest $request)
    {
        $category = new Category();
        $category->name = request('name');

        $category->save();
        return back()->with('success', 'The '.$category->name.' has been created successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit_category', compact('category'));
    }

    public function update(saveCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = request('name');

        $category->update();
        return back()->with('success', 'The '.$category->name.' has been updated successfully!');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success', 'The '.$category->name.' has been deleted successfully!');
    }
}
