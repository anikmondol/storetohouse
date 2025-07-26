<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class VehicleController extends Controller
{
    public function index()
    {

        $vehicles = Vehicle::all();

        return view('dashboard.vehicle.index', compact('vehicles'));
    }


    public function create()
    {


        return view('dashboard.vehicle.create ');
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'route_no' => 'required|string',
            'model_no' => 'required|string',
            'date' => 'required',
            'note' => 'nullable|string',
            'created_by' => 'required|string'
        ]);

        try {
            Vehicle::create([
                'route_no' => $request->route_no,
                'model_no' => $request->model_no,
                'registration_date' => $request->date,
                'note' => $request->note,
                'status' => $request->has('status') ? 1 : 0,
                'created_by' => $request->created_by,
            ]);

            return redirect()->route('vehicle.index')->with('success', 'Vehicle saved successfully!');
        } catch (\Exception $e) {


            dd($e->getMessage());

            return redirect()->back()->with('error', 'Failed to save vehicle. Please try again.');
        }
    }


    public function edit($id)
    {

        $vehicle = Vehicle::where('id', $id)->first();

        return view('dashboard.vehicle.edit', compact('vehicle'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'route_no' => 'required|string',
            'model_no' => 'required|string',
            'date' => 'required',
            'note' => 'nullable|string',
            'created_by' => 'required|string'
        ]);

        try {
            $vehicle = Vehicle::findOrFail($id); // Find the vehicle or fail with 404

            $vehicle->update([
                'route_no' => $request->route_no,
                'model_no' => $request->model_no,
                'registration_date' => $request->date,
                'note' => $request->note,
                'status' => $request->has('status') ? 1 : 0,
                'created_by' => $request->created_by,
            ]);

            return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully!');
        } catch (\Exception $e) {
            // For debugging during development
            dd($e->getMessage());

            return redirect()->route('vehicle.index')->with('error', 'Failed to update vehicle. Please try again.');
        }
    }



    public function destroy($id)
    {

        $vehicle = Vehicle::where('id', $id)->first();

        Vehicle::find($vehicle->id)->delete();
        return redirect()->route('vehicle.index')->with('success', 'Vehicle Delete Successfull');
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
