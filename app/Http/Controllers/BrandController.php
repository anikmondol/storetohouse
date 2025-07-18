<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BrandController extends Controller
{
    public function index()
    {

        $brands = Brand::all();
        return view('dashboard.brand.index', compact('brands'));
    }


    public function create()
    {

        return view('dashboard.brand.create ');
    }

    public function store(Request $request)
    {


        $validated = $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_country' => 'required|string|max:255',
            'brand_entry' => 'nullable',
        ]);


        $brand = new Brand();
        $brand->brand_name = $validated['brand_name'];
        $brand->brand_country = $validated['brand_country'];
        $brand->brand_entry = $validated['brand_entry'];
        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Brand Created Complete.');
    }

    public function edit($id)
    {

        $brand = Brand::where('id', $id)->first();

        return view('dashboard.brand.edit', compact('brand'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_country' => 'required|string|max:255',
            'brand_entry' => 'nullable',
        ]);

        $brand = Brand::findOrFail($id);

        $brand->brand_name = $validated['brand_name'];
        $brand->brand_country = $validated['brand_country'];
        $brand->brand_entry = $validated['brand_entry'];
        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Brand updated successfully.');
    }



    public function destroy($id)
    {


        $brand = Brand::where('id', $id)->first();

        Brand::find($brand->id)->delete();
        return redirect()->route('brand.index')->with('success', 'Brand Delete Successfull');
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
