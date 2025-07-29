<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\Category;
use App\Models\Received;
use App\Models\Maintenance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ReceivedController extends Controller
{
    public function index()
    {


        $receives = DB::select("
    SELECT receiveds.*, items.item_name AS item_name, items.description AS item_description
    FROM receiveds
    JOIN items ON receiveds.item_name = items.id
    ORDER BY receiveds.created_at DESC
");

        return view('dashboard.received.index', compact('receives'));
    }

    public function create()
    {

        $vehicles =  Item::where('status', 1)->get();

        return view('dashboard.received.create', compact('vehicles'));
    }



    public function store(Request $request)
    {

        // dd($request->all());

        try {
            $data = $request->validate([
                'item_name'    => 'required|string',
                'quantity'     => 'required|integer',
                'unit_price'   => 'required|numeric',
                'remarks'      => 'nullable|string',
                'received_by'  => 'required|string',
                'maint_date' => 'required|date',
                'status'       => 'nullable',
                'item_description'       => 'nullable',
            ]);

            $data['status'] = $request->has('status') ? 1 : 0;

            // ✅ Add user_id from logged-in user
            $data['user_id'] = auth()->user()->id;
            $data['created_at'] = now();
            $data['updated_at'] = now();

            Received::create($data);

            return redirect()->route('received.index')->with('success', 'Received saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }



    public function edit($id)
    {

        $items =  Item::where('status', 1)->get();
        $received =  Received::where('id', $id)->first();

        return view('dashboard.received.edit', compact('received', 'items'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'item_name'         => 'required|string',
                'quantity'          => 'required|integer',
                'unit_price'        => 'required|numeric',
                'remarks'           => 'nullable|string',
                'received_by'       => 'required|string',
                'maint_date'        => 'required|date',
                'status'            => 'nullable',
                'item_description'  => 'nullable|string',
            ]);

            $data['status'] = $request->has('status') ? 1 : 0;
            $data['user_id'] = auth()->user()->id;
            $data['updated_at'] = now(); // created_at auto thakbe

            $received = Received::findOrFail($id);
            $received->update($data);

            return redirect()->route('received.index')->with('success', 'Received updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }




    public function destroy($id)
    {

        $vehicle =  Received::where('id', $id)->first();

        Received::find($vehicle->id)->delete();
        return redirect()->route('received.index')->with('success', 'Received Item Delete Successfull');
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
