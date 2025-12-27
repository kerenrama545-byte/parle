<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Index;
use Illuminate\Support\Facades\File;

class IndexManager extends Component
{
    use WithFileUploads;

    public $quote;
    public $description_1;
    public $description_2;

    public $bg_img;
    public $image;

    public $oldBg;
    public $oldImage;

    public function mount()
    {
        $index = Index::first();

        if ($index) {
            $this->quote = $index->quote;
            $this->description_1 = $index->description_1;
            $this->description_2 = $index->description_2;
            $this->oldBg = $index->bg_img;
            $this->oldImage = $index->image;
        }
    }

    public function save()
    {
        $this->validate([
            'quote' => 'required|string',
            'description_1' => 'nullable|string',
            'description_2' => 'nullable|string',
            'bg_img' => 'nullable|image|max:2048',
            'image' => 'nullable|image|max:2048',
        ]);

        $index = Index::first() ?? new Index();

        // pastikan folder public/index ada
        if (!File::exists(public_path('index'))) {
            File::makeDirectory(public_path('index'), 0755, true);
        }

        // ================= BG IMAGE =================
        if ($this->bg_img) {

            if ($index->bg_img && File::exists(public_path('index/' . $index->bg_img))) {
                File::delete(public_path('index/' . $index->bg_img));
            }

            $bgName = 'bg_' . time() . '.' . $this->bg_img->getClientOriginalExtension();

            // WAJIB storeAs
            $this->bg_img->storeAs(
                '',
                $bgName,
                'public_index'
            );

            $index->bg_img = $bgName;
        }

        // ================= IMAGE =================
        if ($this->image) {

            if ($index->image && File::exists(public_path('index/' . $index->image))) {
                File::delete(public_path('index/' . $index->image));
            }

            $imgName = 'img_' . time() . '.' . $this->image->getClientOriginalExtension();

            $this->image->storeAs(
                '',
                $imgName,
                'public_index'
            );

            $index->image = $imgName;
        }

        $index->quote = $this->quote;
        $index->description_1 = $this->description_1;
        $index->description_2 = $this->description_2;
        $index->save();

        $this->oldBg = $index->bg_img;
        $this->oldImage = $index->image;

        session()->flash('success', 'Index berhasil disimpan');
    }

    public function render()
    {
        return view('livewire.index-manager');
    }
}
