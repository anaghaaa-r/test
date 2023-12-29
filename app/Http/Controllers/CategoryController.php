<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function list()
    {
        $categories = Category::latest()->get();
        $trashed = Category::onlyTrashed()->latest()->get();

        return view('category/category-list', [
            'categories' => $categories,
            'trashed' => $trashed
        ]);
    }

    public function index($id = false)
    {
        $category = new Category();
        if($id)
        {
            $category = Category::findOrFail($id);
        }
        return view('category.category', [
            'category' => $category
        ]);
    }

    public function save(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|unique:categories'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = $request->category_id;
        if($id)
        {
            $category = Category::findOrFail($id);
        }
        else
        {
            $category = new Category();
        }
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category.list');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.list');
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('category.list');
    }


}
