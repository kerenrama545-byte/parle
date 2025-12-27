<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\About;
use Illuminate\Support\Facades\File;

class AboutManager extends Component
{
    use WithFileUploads;

    public $quote;
    public $description;
    public $opening_hours_description;

    public $image_1;
    public $image_2;

    public $oldImage1;
    public $oldImage2;

    public function mount()
    {
        $about = About::first();
        if ($about) {
            $this->quote = $about->quote;
            $this->description = $about->description;
            $this->opening_hours_description = $about->opening_hours_description;
            $this->oldImage1 = $about->image_1;
            $this->oldImage2 = $about->image_2;
        }
    }

    public function save()
    {
        $this->validate([
            'quote' => 'required|string',
            'description' => 'nullable|string',
            'opening_hours_description' => 'nullable|string',
            'image_1' => 'nullable|image|max:2048',
            'image_2' => 'nullable|image|max:2048',
        ]);

        $about = About::first() ?? new About();

        $targetPath = public_path('about');
        if (!File::exists($targetPath)) {
            File::makeDirectory($targetPath, 0755, true);
        }

        // image_1
        if ($this->image_1) {
            if ($about->image_1 && File::exists(public_path($about->image_1))) {
                File::delete(public_path($about->image_1));
            }
            $name1 = 'image1_' . time() . '.' . $this->image_1->getClientOriginalExtension();
            File::move($this->image_1->getRealPath(), $targetPath . '/' . $name1);
            $about->image_1 = 'about/' . $name1;
        }

        // image_2
        if ($this->image_2) {
            if ($about->image_2 && File::exists(public_path($about->image_2))) {
                File::delete(public_path($about->image_2));
            }
            $name2 = 'image2_' . time() . '.' . $this->image_2->getClientOriginalExtension();
            File::move($this->image_2->getRealPath(), $targetPath . '/' . $name2);
            $about->image_2 = 'about/' . $name2;
        }

        $about->quote = $this->quote;
        $about->description = $this->description;
        $about->opening_hours_description = $this->opening_hours_description;
        $about->save();

        // update old images & reset file inputs
        $this->oldImage1 = $about->image_1;
        $this->oldImage2 = $about->image_2;
        $this->image_1 = null;
        $this->image_2 = null;

        session()->flash('success', 'About berhasil disimpan');
    }

    public function render()
    {
        return view('livewire.about-manager');
    }
}
