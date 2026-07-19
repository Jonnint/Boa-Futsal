<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index(Request $request)
    {
        $query = Voucher::withCount('usages');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Search by code or name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        $vouchers = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'               => 'required|string|max:20|unique:vouchers,code',
            'name'               => 'required|string|max:255',
            'description'        => 'nullable|string',
            'type'               => 'required|in:percentage,fixed',
            'discount_value'     => 'required|numeric|min:0',
            'min_booking_amount' => 'nullable|numeric|min:0',
            'max_discount'       => 'nullable|numeric|min:0',
            'valid_from'         => 'required|date',
            'valid_until'        => 'required|date|after:valid_from',
            'is_member_only'     => 'nullable',
            'usage_limit'        => 'nullable|integer|min:1',
            'usage_per_user'     => 'nullable|integer|min:1',
            'applicable_days'    => 'nullable|array',
            'applicable_days.*'  => 'integer|between:0,6',
        ]);

        // Validate percentage <= 100
        if ($validated['type'] === 'percentage' && $validated['discount_value'] > 100) {
            return back()->withErrors(['discount_value' => 'Diskon persentase tidak boleh melebihi 100%'])->withInput();
        }

        Voucher::create([
            'code'               => strtoupper($validated['code']),
            'name'               => $validated['name'],
            'description'        => $validated['description'] ?? null,
            'type'               => $validated['type'],
            'discount_value'     => $validated['discount_value'],
            'min_booking_amount' => $validated['min_booking_amount'] ?? null,
            'max_discount'       => ($validated['type'] === 'percentage') ? ($validated['max_discount'] ?? null) : null,
            'valid_from'         => $validated['valid_from'],
            'valid_until'        => $validated['valid_until'],
            'is_member_only'     => $request->has('is_member_only'),
            'usage_limit'        => $validated['usage_limit'] ?? null,
            'usage_per_user'     => $validated['usage_per_user'] ?? 1,
            'applicable_days'    => !empty($validated['applicable_days']) ? $validated['applicable_days'] : null,
            'applicable_times'   => null,
            'is_active'          => true,
        ]);

        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Voucher ' . strtoupper($validated['code']) . ' berhasil dibuat!');
    }

    public function show(Voucher $voucher)
    {
        $voucher->load(['usages.user', 'usages.booking']);
        $voucher->loadCount('usages');
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function edit(Voucher $voucher)
    {
        $voucher->loadCount('usages');
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $validated = $request->validate([
            'code'               => 'required|string|max:20|unique:vouchers,code,' . $voucher->id,
            'name'               => 'required|string|max:255',
            'description'        => 'nullable|string',
            'type'               => 'required|in:percentage,fixed',
            'discount_value'     => 'required|numeric|min:0',
            'min_booking_amount' => 'nullable|numeric|min:0',
            'max_discount'       => 'nullable|numeric|min:0',
            'valid_from'         => 'required|date',
            'valid_until'        => 'required|date|after:valid_from',
            'is_member_only'     => 'nullable',
            'usage_limit'        => 'nullable|integer|min:1',
            'usage_per_user'     => 'nullable|integer|min:1',
            'applicable_days'    => 'nullable|array',
            'applicable_days.*'  => 'integer|between:0,6',
        ]);

        if ($validated['type'] === 'percentage' && $validated['discount_value'] > 100) {
            return back()->withErrors(['discount_value' => 'Diskon persentase tidak boleh melebihi 100%'])->withInput();
        }

        $voucher->update([
            'code'               => strtoupper($validated['code']),
            'name'               => $validated['name'],
            'description'        => $validated['description'] ?? null,
            'type'               => $validated['type'],
            'discount_value'     => $validated['discount_value'],
            'min_booking_amount' => $validated['min_booking_amount'] ?? null,
            'max_discount'       => ($validated['type'] === 'percentage') ? ($validated['max_discount'] ?? null) : null,
            'valid_from'         => $validated['valid_from'],
            'valid_until'        => $validated['valid_until'],
            'is_member_only'     => $request->has('is_member_only'),
            'usage_limit'        => $validated['usage_limit'] ?? null,
            'usage_per_user'     => $validated['usage_per_user'] ?? 1,
            'applicable_days'    => !empty($validated['applicable_days']) ? $validated['applicable_days'] : null,
        ]);

        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Voucher ' . strtoupper($validated['code']) . ' berhasil diperbarui!');
    }

    public function destroy(Voucher $voucher)
    {
        $code = $voucher->code;
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Voucher ' . $code . ' berhasil dihapus.');
    }

    public function toggle(Voucher $voucher)
    {
        $voucher->update(['is_active' => !$voucher->is_active]);
        $status = $voucher->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Voucher {$voucher->code} berhasil {$status}.");
    }
}
