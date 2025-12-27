<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\FeaturedMenu;
use Illuminate\Support\Facades\File;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class FeaturedMenuManager extends Component
{
    use WithFileUploads;

    public $quote;
    public $title;
    public $description;

    public $image_1;
    public $image_2;

    public $oldImage1;
    public $oldImage2;

    public function mount()
    {
        if ($data = FeaturedMenu::first()) {
            $this->quote = $data->quote;
            $this->title = $data->title;
            $this->description = $data->description;
            $this->oldImage1 = $data->image_1;
            $this->oldImage2 = $data->image_2;
        }
    }

    public function save()
    {
        $this->validate([
            'quote' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_1' => 'nullable|image|max:2048',
            'image_2' => 'nullable|image|max:2048',
        ]);

        $menu = FeaturedMenu::first() ?? new FeaturedMenu();

        /* ===== PASTIKAN FOLDER ===== */
        $targetPath = public_path('featured-menu');
        if (!File::exists($targetPath)) {
            File::makeDirectory($targetPath, 0755, true);
        }

        /* ===== IMAGE 1 ===== */
        if ($this->image_1 instanceof TemporaryUploadedFile) {

            if ($menu->image_1 && File::exists(public_path($menu->image_1))) {
                File::delete(public_path($menu->image_1));
            }

            $name = 'image_1_' . time() . '.' . $this->image_1->getClientOriginalExtension();
            File::move($this->image_1->getRealPath(), $targetPath.'/'.$name);

            $menu->image_1 = 'featured-menu/'.$name;
            $this->oldImage1 = $menu->image_1;
        }

        /* ===== IMAGE 2 ===== */
        if ($this->image_2 instanceof TemporaryUploadedFile) {

            if ($menu->image_2 && File::exists(public_path($menu->image_2))) {
                File::delete(public_path($menu->image_2));
            }

            $name = 'image_2_' . time() . '.' . $this->image_2->getClientOriginalExtension();
            File::move($this->image_2->getRealPath(), $targetPath.'/'.$name);

            $menu->image_2 = 'featured-menu/'.$name;
            $this->oldImage2 = $menu->image_2;
        }

        /* ===== SAVE TEXT ===== */
        $menu->quote = $this->quote;
        $menu->title = $this->title;
        $menu->description = $this->description;
        $menu->save();

        // 🔥 WAJIB RESET FILE
        $this->reset(['image_1', 'image_2']);

        session()->flash('success', 'Featured Menu berhasil disimpan');
    }

    public function render()
    {
        return view('livewire.featured-menu-manager');
    }
}
