<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function showScanCam()
    {
        return view('scan', [
            'action' => 'scanning',
        ]);
    }

    public function showAddCam()
    {
        return view('scan', [
            'action' => 'adding',
        ]);
    }

    public function showEditCam()
    {
        return view('scan', [
            'action' => 'editing',
        ]);
    }

    public function showList()
    {
        $inventories = Inventory::all();

        return view('list', [
            'inventories' => $inventories,
        ]);
    }

    public function showDetailPage(Request $request)
    {
        $inventory = Inventory::where('qr_code', $request->input('scannedQRCode'))->first();

        if ($inventory) {
            session()->flash('inventory', $inventory);
        } else {
            return response()->json(['notfound' => true]);
        }
    }

    public function showDetailFromSession()
    {
        if (session()->has('inventory')) {
            $inventory = session('inventory');
            return view('detail', [
                'name' => $inventory->name,
                'brand' => $inventory->brand,
                'user' => $inventory->user,
                'year' => $inventory->year,
                'id' => $inventory->id,
            ]);
        }
    }

    public function showDetailPage2($id)
    {
        $inventory = Inventory::findOrFail($id);

        return view('detail', [
            'name' => $inventory->name,
            'brand' => $inventory->brand,
            'user' => $inventory->user,
            'year' => $inventory->year,
            'id' => $inventory->id,
        ]);
    }

    public function showAddPage(Request $request)
    {
        $inventory = Inventory::where('qr_code', $request->input('scannedQRCode'))->first();

        if ($inventory) {
            return response()->json(['found' => true]);
        } else {
            session()->flash('request', $request->input('scannedQRCode'));
        }
    }

    public function showAddFromSession()
    {
        if (session()->has('request')) {
            $request = session('request');
            return view('add', [
                'scannedQRCode' => $request,
            ]);
        }
    }

    public function saveInv(Request $request)
    {
        $inventory = new Inventory();
        $inventory->qr_code = $request->input('qr_code');
        $inventory->name = $request->input('name');
        $inventory->brand = $request->input('brand');
        $inventory->user = $request->input('user');
        $inventory->year = $request->input('year');
        $inventory->save();

        return redirect()->route('list.page')->with('success', 'Inventory has been successfully added.');
    }

    public function showEditPage($id)
    {
        $inventory = Inventory::findOrFail($id);

        return view('edit', [
            'inventory' => $inventory,
        ]);
    }

    public function showEditPage2(Request $request)
    {
        $inventory = Inventory::where('qr_code', $request->input('scannedQRCode'))->first();

        if ($inventory) {
            session()->flash('inventory', $inventory);
        } else {
            return response()->json(['notfound' => true]);
        }
    }

    public function showEditFromSession()
    {
        if (session()->has('inventory')) {
            $inventory = session('inventory');
            return view('edit', [
                'inventory' => $inventory,
            ]);
        }
    }

    public function saveEdit(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $inventory->name = $request->input('name');
        $inventory->brand = $request->input('brand');
        $inventory->user = $request->input('user');
        $inventory->year = $request->input('year');
        $inventory->save();

        return redirect()->route('detail.page2', ['id' => $inventory->id])->with('success', 'Inventory updated successfully.');
    }

    public function processDelete(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $inventory->delete();

        return redirect()->route('list.page')->with('success', 'Inventory deleted.');
    }
}
