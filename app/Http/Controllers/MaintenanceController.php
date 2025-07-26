<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\Category;
use App\Models\Maintenance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MaintenanceController extends Controller
{
    public function index()
    {

        $maintenances = Maintenance::all();

        return view('dashboard.maintenance.index', compact('maintenances'));
    }

    public function create()
    {

        $vehicles =  Vehicle::where('status', 1)->get();

        return view('dashboard.maintenance.create', compact('vehicles'));
    }


    public function store(Request $request)
    {


        try {
            // Validation
            $request->validate([

                'maint_date'  => 'required',
                'bus_id'      => 'nullable|string',
                'description' => 'nullable|string',
                'amount'      => 'nullable|numeric|min:0',
                'remarks'     => 'nullable|string',
                'status'      => 'required',
                'entry_by'    => 'required|string',
            ]);

            // Insert into database
            Maintenance::create([

                'maint_date'  => $request->maint_date,
                'bus_id'      => $request->bus_id,
                'description' => $request->description,
                'amount'      => $request->amount,
                'remarks'     => $request->remarks,
                'description' => $request->note,
                'status' => $request->has('status') ? 1 : 0,
                'entry_by'    => $request->entry_by,
            ]);

            return redirect()->route('maintenance.index')->with('success', 'Maintenances saved successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {

        $vehicles =  Vehicle::where('status', 1)->get();
        $maintenance =  Maintenance::where('id', $id)->first();

        return view('dashboard.maintenance.edit', compact('maintenance', 'vehicles'));
    }


    // public function update(Request $request, $id)
    // {

    //     $request->validate([
    //         'route_no' => 'required|string',
    //         'model_no' => 'required|string',
    //         'date' => 'required',
    //         'note' => 'nullable|string',
    //         'created_by' => 'required|string'
    //     ]);

    //     try {
    //         $vehicle =  Maintenance::findOrFail($id); // Find the vehicle or fail with 404

    //         $vehicle->update([
    //             'route_no' => $request->route_no,
    //             'model_no' => $request->model_no,
    //             'registration_date' => $request->date,
    //             'note' => $request->note,
    //             'status' => $request->has('status') ? 1 : 0,
    //             'created_by' => $request->created_by,
    //         ]);

    //         return redirect()->route('maintenance.index')->with('success', 'Vehicle updated successfully!');
    //     } catch (\Exception $e) {
    //         // For debugging during development
    //         dd($e->getMessage());

    //         return redirect()->route('maintenance.index')->with('error', 'Failed to update maintenance. Please try again.');
    //     }
    // }


    public function update(Request $request, $id)
    {

        // dd($request->all());

        try {
            // Validation
            $request->validate([
                'maint_date'  => 'required',
                'bus_id'      => 'nullable|string',
                'description' => 'nullable|string',
                'amount'      => 'nullable|numeric|min:0',
                'remarks'     => 'nullable|string',
                'status'      => 'required',
                'entry_by'    => 'required|string',
            ]);

            // Find the record
            $maintenance = Maintenance::findOrFail($id);

            // Update the record
            $maintenance->update([
                'maint_date'  => $request->maint_date,
                'bus_id'      => $request->bus_id,
                'description' => $request->description ?? $request->note,
                'amount'      => $request->amount,
                'remarks'     => $request->remarks,
                'status'      => $request->has('status') ? 1 : 0,
                'entry_by'    => $request->entry_by,
            ]);

            return redirect()->route('maintenance.index')->with('success', 'Maintenance updated successfully!');
        } catch (\Exception $e) {
            // During development:
            dd($e->getMessage());

            return redirect()->route('maintenance.index')->with('error', 'Failed to update maintenance: ' . $e->getMessage());
        }
    }



    public function destroy($id)
    {

        $vehicle =  Maintenance::where('id', $id)->first();

        Maintenance::find($vehicle->id)->delete();
        return redirect()->route('maintenance.index')->with('success', 'Vehicle Delete Successfull');
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
