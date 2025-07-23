<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function index()
    {



        $categories = Category::all();

        return view('dashboard.category.index', compact('categories'));
    }


    public function create()
    {

        return view('dashboard.category.create ');
    }

    public function store(Request $request)
    {


        $request->validate([
            'category_name' => 'required|string|max:255',
            'entry_by' => 'required|string|max:100'
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'entry_by' => $request->entry_by
        ]);


        return redirect()->route('category.index')->with('success', 'Brand Created Complete.');
    }

    public function edit($id)
    {



        $category = Category::where('id', $id)->first();

        return view('dashboard.category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'entry_by' => 'nullable|string|max:100',
        ]);

        // Find the category
        $category = Category::findOrFail($id);

        // Update fields
        $category->category_name = $validated['category_name'];
        $category->entry_by = $validated['entry_by'];
        $category->save();

        // Redirect with success message
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }



    public function destroy($id)
    {


        $brand = Category::where('id', $id)->first();

        Category::find($brand->id)->delete();
        return redirect()->route('category.index')->with('success', 'Category Delete Successfull');
    }

    public function status($slug)
    {
        $category = Category::where('slug', $slug)->first();


        if ($category->status == 'active') {
            Category::find($category->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return redirect()->route('category.index')->with('category_success', 'Category Status Change Successfull');
        } else {
            Category::find($category->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return redirect()->route('category.index')->with('category_success', 'Category Status Change Successfull');
        }
    }
}
