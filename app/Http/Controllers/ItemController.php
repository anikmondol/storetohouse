<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;


class ItemController extends Controller
{
    public function index()
    {

        $items = DB::table('items')
            ->join('brands', 'items.brand', '=', 'brands.id')
            ->join('categories', 'items.category', '=', 'categories.id')
            ->select('items.*', 'brands.brand_name', 'categories.category_name')
            ->get();
        return view('dashboard.item.index', compact('items'));
    }


    public function create()
    {

        $stores  = Store::all();
        $categories = Category::all();
        $brands = Brand::all();

        return view('dashboard.item.create ', compact('stores', 'categories', 'brands'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'item_name'       => 'required|string|max:255',
            'brand'           => 'required|exists:brands,id',
            'category'        => 'required|exists:categories,id',
            'item_unit'       => 'required|in:pcs,kg,litre',
            'item_entry_by'   => 'required|string|max:255',
            'description'     => 'nullable|string',
        ]);

        // Create the item
        Item::create([
            'item_name'      => $request->item_name,
            'brand'          => $request->brand,
            'category'       => $request->category,
            'item_unit'      => $request->item_unit,
            'item_entry_by'  => $request->item_entry_by,
            'description'    => $request->description,
        ]);

        // Redirect with success message
        return redirect()->route('item.index')->with('success', 'Item created successfully!');
    }


    public function edit($id)
    {
        $item = Item::findOrFail($id);

        $brands = Brand::all();
        $categories = Category::all();

        return view('dashboard.item.edit', compact('item', 'brands', 'categories'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'item_name'     => 'required|string|max:255',
            'brand'         => 'nullable|exists:brands,id',
            'category'      => 'nullable|exists:categories,id',
            'item_unit'     => 'nullable|in:pcs,kg,litre',
            'item_entry_by' => 'nullable|string|max:255',
            'description'   => 'nullable|string',
        ]);


        $item = Item::findOrFail($id);


        $item->item_name     = $request->item_name;
        $item->brand         = $request->brand;
        $item->category      = $request->category;
        $item->item_unit     = $request->item_unit;
        $item->item_entry_by = $request->item_entry_by;
        $item->description   = $request->description;

        $item->save();

        return redirect()->route('item.index')->with('success', 'Item updated successfully!');
    }




    public function destroy($id)
    {

        $item = Item::where('id', $id)->first();

        Item::find($item->id)->delete();
        return redirect()->route('item.index')->with('success', 'Item Delete Successfull');
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
