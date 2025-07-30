<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\Category;
use App\Models\Damage;
use App\Models\Received;
use App\Models\Maintenance;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DamageController extends Controller
{
    public function index()
    {
        try {
            $damages = DB::select("
            SELECT
                damages.*,
                items.item_name AS item_name,
                items.description AS item_description,
                stores.store_name AS store_name
            FROM damages
            JOIN items ON damages.item_name = items.id
            JOIN stores ON damages.store_id = stores.id
            ORDER BY damages.created_at DESC
        ");


            return view('dashboard.damage.index', compact('damages'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load received list: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {

            $items = Item::where('status', 1)->get();
            $stores = Store::where('status', 1)->get();

            return view('dashboard.damage.create', compact('items', 'stores'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load form: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {



            $data = $request->validate([
                'item_name'    => 'required|string',
                'store_id'     => 'required|integer|exists:stores,id', // ✅ ঠিক করো
                'item_qty'     => 'required|integer|min:1',
                'remarks'      => 'nullable|string',
                'entry_by'     => 'required|string',
                'damage_date'  => 'required|date',
                'status'       => 'nullable',
                'item_description' => 'nullable|string',
            ]);


            $data['status'] = $request->has('status') ? 1 : 0;
            $data['user_id'] = auth()->user()->id;
            $data['created_at'] = now();
            $data['updated_at'] = now();

            Damage::create($data);

            return redirect()->route('damage.index')->with('success', 'Received saved successfully!');
        } catch (\Exception $e) {

            dd($e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $items = Item::where('status', 1)->get();
            $stores = Store::where('status', 1)->get();
            $damage = Damage::where('id', $id)->firstOrFail();
            return view('dashboard.damage.edit', compact('damage', 'items', 'stores'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $data = $request->validate([
                'item_name'    => 'required|string',
                'store_id'     => 'required|integer|exists:stores,id',
                'item_qty'     => 'required|integer|min:1',
                'remarks'      => 'nullable|string',
                'entry_by'     => 'required|string',
                'damage_date'  => 'required|date',
                'status'       => 'nullable',
                'item_description' => 'nullable|string',
            ]);

            // 🛠 Set status and timestamps
            $data['status'] = $request->has('status') ? 1 : 0;
            $data['user_id'] = auth()->user()->id;
            $data['updated_at'] = now();

            // 🔄 Find the damage record and update
            $damage = Damage::findOrFail($id);
            $damage->update($data);

            return redirect()->route('damage.index')->with('success', 'Damage record updated successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $received = Damage::findOrFail($id);
            $received->delete();
            return redirect()->route('damage.index')->with('success', 'Received Item Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete: ' . $e->getMessage());
        }
    }

    public function status($slug)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();

            $newStatus = ($category->status == 'active') ? 'deactive' : 'active';
            $category->update([
                'status' => $newStatus,
                'updated_at' => now(),
            ]);

            return redirect()->route('category.index')->with('category_success', 'Category Status Changed Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to change status: ' . $e->getMessage());
        }
    }
}
