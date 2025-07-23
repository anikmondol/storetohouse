<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class StoreController extends Controller
{
    public function index()
    {

        $stores  = Store::all();

        return view('dashboard.store.index', compact('stores'));
    }


    public function create()
    {

        return view('dashboard.store.create ');
    }

    public function store(Request $request)
    {

        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_location' => 'required|string|max:255',
            'store_entry_by' => 'nullable|string|max:255'
        ]);

        Store::create($request->all());

        return redirect()->route('store.index')->with('success', 'Store saved successfully!');
    }

    public function edit($id)
    {

        $store =  Store::where('id', $id)->first();

        return view('dashboard.store.edit', compact('store'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'store_location' => 'required|string|max:255',
            'store_entry_by' => 'nullable|string|max:255',
        ]);

        $store = Store::findOrFail($id);
        $store->update($validated);

        return redirect()->route('store.index')->with('success', 'Store updated successfully!');
    }




    public function destroy($id)
    {


        $brand =  Store::where('id', $id)->first();

        Store::find($brand->id)->delete();
        return redirect()->route('store.index')->with('success', 'Category Delete Successfull');
    }

    public function status($slug)
    {
        $category =  Store::where('slug', $slug)->first();


        if ($category->status == 'active') {
            Store::find($category->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return redirect()->route('store.index')->with('category_success', 'Category Status Change Successfull');
        } else {
            Store::find($category->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return redirect()->route('store.index')->with('category_success', 'Category Status Change Successfull');
        }
    }
}
