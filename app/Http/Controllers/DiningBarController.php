<?php

namespace App\Http\Controllers;

use App\Models\DiningBar;
use App\Models\DiningBarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DiningBarController extends Controller
{
    /* ================= STORE / UPDATE ================= */
    public function store(Request $request)
    {
        $request->validate([
            'motto'            => 'required|string|max:255',
            'title'            => 'required|string|max:255',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Ambil atau buat 1 data saja
        $dining = DiningBar::firstOrCreate(
            [],
            [
                'motto' => $request->motto,
                'title' => $request->title,
            ]
        );

        $dining->update($request->only('motto', 'title'));

        /* ===== Background Image ===== */
        if ($request->hasFile('background_image')) {
            if ($dining->background_image && File::exists(public_path($dining->background_image))) {
                File::delete(public_path($dining->background_image));
            }

            $bgFile = $request->file('background_image');
            $bgName = 'bg_' . time() . '_' . uniqid() . '.' . $bgFile->getClientOriginalExtension();
            $bgFile->move(public_path('dining-bar'), $bgName);

            $dining->update([
                'background_image' => 'dining-bar/' . $bgName
            ]);
        }

        /* ===== Gallery Images ===== */
        $this->uploadImages($request, $dining);

        return redirect()
            ->route('dining-bar.index')
            ->with('success', 'Dining & Bar berhasil disimpan');
    }

    /* ================= DELETE SINGLE IMAGE ================= */
    public function deleteImage($id)
    {
        $image = DiningBarImage::findOrFail($id);

        if (File::exists(public_path($image->image))) {
            File::delete(public_path($image->image));
        }

        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus');
    }

    /* ================= UPLOAD IMAGE FUNCTION ================= */
    private function uploadImages(Request $request, DiningBar $diningBar)
    {
        if (!$request->hasFile('images')) {
            return;
        }

        $path = public_path('dining-bar');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        foreach ($request->file('images') as $image) {
            $name = 'dining_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $name);

            DiningBarImage::create([
                'dining_bar_id' => $diningBar->id,
                'image'         => 'dining-bar/' . $name,
            ]);
        }
    }
}
