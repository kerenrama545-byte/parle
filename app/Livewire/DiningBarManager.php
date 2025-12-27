<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\DiningBar;
use App\Models\DiningBarImage;
use Illuminate\Support\Facades\File;

class DiningBarManager extends Component
{
    use WithFileUploads;

    public $motto;
    public $title;
    public $subtitle;

    public $background_image;
    public $images = [];

    public $oldBackground;
    public $gallery = [];

    public function addImage()
{
    $this->images[] = null;
}

public function removeImage($index)
{
    unset($this->images[$index]);
    $this->images = array_values($this->images);
}


    public function mount()
    {
        $dining = DiningBar::with('images')->first();

        if ($dining) {
            $this->motto = $dining->motto;
            $this->title = $dining->title;
            $this->subtitle = $dining->subtitle;
            $this->oldBackground = $dining->background_image;
            $this->gallery = $dining->images;
        }
    }

    public function save()
    {
        $this->validate([
            'motto' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $dining = DiningBar::first() ?? new DiningBar();

        /* ================= FOLDER ================= */
        if (!File::exists(public_path('dining-bar'))) {
            File::makeDirectory(public_path('dining-bar'), 0755, true);
        }

        /* ================= BACKGROUND IMAGE ================= */
        if ($this->background_image) {

            if ($dining->background_image && File::exists(public_path($dining->background_image))) {
                File::delete(public_path($dining->background_image));
            }

            $bgName = 'background_image.' . $this->background_image->getClientOriginalExtension();

            $this->background_image->storeAs(
                '',
                $bgName,
                'public_dining'
            );

            $dining->background_image = 'dining-bar/' . $bgName;
        }

        /* ================= MAIN DATA ================= */
        $dining->motto = $this->motto;
        $dining->title = $this->title;
        $dining->subtitle = $this->subtitle;
        $dining->save();

        /* ================= GALLERY ================= */
        if (!empty($this->images)) {
            foreach ($this->images as $img) {

                $name = 'gallery_' . time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();

                $img->storeAs(
                    '',
                    $name,
                    'public_dining'
                );

                DiningBarImage::create([
                    'dining_bar_id' => $dining->id,
                    'image' => 'dining-bar/' . $name,
                ]);
            }
        }

        $this->oldBackground = $dining->background_image;
        $this->gallery = $dining->images()->get();
        $this->reset('background_image', 'images');

        session()->flash('success', 'Dining & Bar berhasil disimpan');
    }

    public function deleteImage($id)
    {
        $image = DiningBarImage::findOrFail($id);

        if (File::exists(public_path($image->image))) {
            File::delete(public_path($image->image));
        }

        $image->delete();

        $this->gallery = DiningBar::first()?->images ?? [];
    }

    

    public function render()
    {
        return view('livewire.dining-bar-manager');
    }
}
