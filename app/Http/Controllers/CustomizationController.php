<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponse;
use App\Http\Resources\CustomizationResource;
use App\Models\Customization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomizationController extends Controller
{

    public function index(): JsonResponse
    {
        $customization = Customization::first();

        if (!$customization) {
            return response()->json([
                'success' => false,
                'message' => 'Customization not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Customization data retrieved successfully.',
            'data' => new CustomizationResource($customization),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'logo' => 'nullable|mimes:jpeg,bmp,png,jpg|max:2048',
            'favicon' => 'nullable|mimes:jpeg,bmp,png,ico|max:1024',
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'third_color' => 'nullable|string|max:7',
        ]);

        $customization = Customization::firstOrNew([]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->getRealPath();
            $logoContent = file_get_contents($logoPath);
            $customization->logo = base64_encode($logoContent);
        }

        if ($request->hasFile('favicon')) {
            $faviconPath = $request->file('favicon')->getRealPath();
            $faviconContent = file_get_contents($faviconPath);
            $customization->favicon = base64_encode($faviconContent);
        }

        $customization->primary_color = $request->input('primary_color', '#FFFFFF');
        $customization->secondary_color = $request->input('secondary_color', '#000000');
        $customization->third_color = $request->input('third_color', '#CCCCCC');

        $customization->save();

        return response()->json([
            'success' => true,
            'message' => 'Logo and favicon uploaded successfully.',
            'data' => new CustomizationResource($customization),
        ]);
    }

//    public function update(Request $request): JsonResponse
//    {
//        $request->validate([
//            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
//            'favicon' => 'nullable|image|mimes:png,ico|max:1024',
//            'primary_color' => 'nullable|string|max:7',
//            'secondary_color' => 'nullable|string|max:7',
//            'third_color' => 'nullable|string|max:7',
//        ]);
//
//        $customization = Customization::first();
//
//        if (!$customization) {
//            return response()->json([
//                'success' => false,
//                'message' => 'Customization settings not found.',
//            ], 404);
//        }
//
//        if ($request->hasFile('logo')) {
//            $logoPath = $request->file('logo')->getRealPath();
//            $logoContent = file_get_contents($logoPath);
//            $customization->logo = base64_encode($logoContent);
//        }
//
//        if ($request->hasFile('favicon')) {
//            $faviconPath = $request->file('favicon')->getRealPath();
//            $faviconContent = file_get_contents($faviconPath);
//            $customization->favicon = base64_encode($faviconContent);
//        }
//
//        $customization->primary_color = $request->input('primary_color', $customization->primary_color);
//        $customization->secondary_color = $request->input('secondary_color', $customization->secondary_color);
//        $customization->third_color = $request->input('third_color', $customization->third_color);
//
//        $customization->save();
//
//        return response()->json([
//            'success' => true,
//            'message' => 'Customization updated successfully.',
//            'data' => new CustomizationResource($customization),
//        ]);
//    }

}
