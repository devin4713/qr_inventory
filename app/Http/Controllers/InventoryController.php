<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;

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
        $authId = Auth::id();
        $inventories = Inventory::where('auth_id', $authId)->get();

        return view('list', [
            'inventories' => $inventories,
        ]);
    }

    public function showDetailPage(Request $request)
    {
        $authId = Auth::id();
        $inventory = Inventory::where('qr_code', $request->input('scannedQRCode'))->where('auth_id', $authId)->first();

        if ($inventory) {
            return response()->json(['id' => $inventory->id]);
        } else {
            return response()->json(['notfound' => true]);
        }
    }

    public function showDetailPage2($id)
    {
        $authId = Auth::id();
        $inventory = Inventory::where('id', $id)->where('auth_id', $authId)->first();

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
        $authId = Auth::id();
        $inventory = Inventory::where('qr_code', $request->input('scannedQRCode'))->where('auth_id', $authId)->first();

        if ($inventory) {
            return response()->json(['found' => true]);
        } else {
            session()->flash('scannedQRCode', $request->input('scannedQRCode'));
        }
    }

    public function showAddFromSession()
    {
        if (session()->has('scannedQRCode')) {
            $scannedQRCode = session('scannedQRCode');
            return view('add', [
                'scannedQRCode' => $scannedQRCode,
            ]);
        } else {
            return redirect()->route('add.cam');
        }
    }

    public function saveInv(Request $request)
    {
        $authId = Auth::id();
        $inventory = new Inventory();
        $inventory->qr_code = $request->input('qr_code');
        $inventory->name = $request->input('name');
        $inventory->brand = $request->input('brand');
        $inventory->user = $request->input('user');
        $inventory->year = $request->input('year');
        $inventory->auth_id = $authId;
        $inventory->save();

        return redirect()->route('list.page')->with('success', 'Inventory has been successfully added.');
    }

    public function showEditPage($id)
    {
        $authId = Auth::id();
        $inventory = Inventory::where('id', $id)->where('auth_id', $authId)->first();

        return view('edit', [
            'inventory' => $inventory,
        ]);
    }

    public function showEditPage2(Request $request)
    {
        $authId = Auth::id();
        $inventory = Inventory::where('qr_code', $request->input('scannedQRCode'))->where('auth_id', $authId)->first();

        if ($inventory) {
            return response()->json(['id' => $inventory->id]);
        } else {
            return response()->json(['notfound' => true]);
        }
    }

    public function saveEdit(Request $request, $id)
    {
        $authId = Auth::id();
        $inventory = Inventory::where('id', $id)->where('auth_id', $authId)->first();

        $inventory->name = $request->input('name');
        $inventory->brand = $request->input('brand');
        $inventory->user = $request->input('user');
        $inventory->year = $request->input('year');
        $inventory->save();

        return redirect()->route('detail.page2', ['id' => $inventory->id])->with('success', 'Inventory updated successfully.');
    }

    public function processDelete(Request $request, $id)
    {
        $authId = Auth::id();
        $inventory = Inventory::where('id', $id)->where('auth_id', $authId)->first();

        $inventory->delete();

        return redirect()->route('list.page')->with('success', 'Inventory deleted.');
    }
}
