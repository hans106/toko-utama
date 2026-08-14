<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreSetting;
use Illuminate\Http\Request;

class StoreSettingController extends Controller
{
    public function edit()
    {
        $setting = StoreSetting::first() ?? new StoreSetting();

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'open_hours' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
        ]);

        $setting = StoreSetting::first();

        if ($setting) {
            $setting->update($validated);
        } else {
            StoreSetting::create($validated);
        }

        return redirect()
            ->route('admin.store-settings.edit')
            ->with('success', 'Pengaturan toko berhasil disimpan.');
    }
};
