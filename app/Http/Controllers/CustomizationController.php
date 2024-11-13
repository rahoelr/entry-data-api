<?php

namespace App\Http\Controllers;

use App\Models\Customization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('role:manager,admin');
    }

    public function index()
    {
        $customization = Customization::first();
        return response()->json($customization);
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:1024',
            'primary_color' => 'nullable|string',
            'secondary_color' => 'nullable|string',
            'third_color' => 'nullable|string',
        ]);

        $customization = Customization::firstOrNew([]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $customization->logo = $logoPath;
        }

        if ($request->hasFile('favicon')) {
            $faviconPath = $request->file('favicon')->store('favicons', 'public');
            $customization->favicon = $faviconPath;
        }

        $customization->primary_color = $request->primary_color ?? $customization->primary_color;
        $customization->secondary_color = $request->secondary_color ?? $customization->secondary_color;
        $customization->third_color = $request->third_color ?? $customization->third_color;

        $customization->save();

        return response()->json(['message' => 'Customization updated successfully', 'data' => $customization]);
    }
}
