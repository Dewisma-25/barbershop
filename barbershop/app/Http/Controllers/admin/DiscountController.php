<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::with('creator')->latest()->get();
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('admin.discounts.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama'            => 'required|string',
                'persen'          => 'required|numeric|min:1|max:100',
                'tanggal_mulai'   => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            ]);

            Discount::create([
                'nama'            => $request->nama,
                'persen'          => $request->persen,
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'is_active'       => 1,
                'created_by'      => Auth::id(),
            ]);

            return redirect()->route('discounts.index')
                ->with('success', 'Successfully added new discount')
                ->with('toast', 'discount_added');
        } catch (\Exception $e) {
            return redirect()->route('discounts.index')
                ->with('error', 'Failed to added a new discount')
                ->with('toast', 'discount_add_error');
        }
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        return view('admin.discounts.edit', compact('discount'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama'            => 'required|string',
                'persen'          => 'required|numeric|min:1|max:100',
                'tanggal_mulai'   => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            ]);

            $discount = Discount::findOrFail($id);
            $discount->update([
                'nama'            => $request->nama,
                'persen'          => $request->persen,
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);

            return redirect()->route('discounts.index')
                ->with('success', 'Succsessfully updated discount')
                ->with('toast', 'discount_edit');
        } catch (\Exception $e) {
            return redirect()->route('discounts.index')
                ->with('error', 'Failed to update discount')
                ->with('toast', 'discount_edit_error');
        }
    }

    public function toggleActive($id)
    {
        try {
            $discount = Discount::findOrFail($id);
            $discount->update(['is_active' => !$discount->is_active]);

            $status = $discount->is_active ? 'activated' : 'inactived';
            return redirect()->route('discounts.index')
                ->with('success', "successfully $status discount")
                ->with('toast', 'discount_status');
        } catch (\Exception $e) {
            return redirect()->route('discounts.index')
                ->with('error', 'failed to change discount status')
                ->with('toast', 'discount_status_error');
        }
    }
}