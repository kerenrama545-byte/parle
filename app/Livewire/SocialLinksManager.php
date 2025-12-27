<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SocialLinks;

class SocialLinksManager extends Component
{
    public $whatsapp;
    public $instagram;
    public $facebook;
    public $twitter;
    public $linkedin;

    public $socialLinksId;

    public function mount()
    {
        $socialLinks = SocialLinks::first();

        if ($socialLinks) {
            $this->socialLinksId = $socialLinks->id;
            $this->whatsapp = $socialLinks->whatsapp;
            $this->instagram = $socialLinks->instagram;
            $this->facebook = $socialLinks->facebook;
            $this->twitter = $socialLinks->twitter;
            $this->linkedin = $socialLinks->linkedin;
        }
    }

    protected $rules = [
        'whatsapp' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'facebook' => 'nullable|string|max:255',
        'twitter' => 'nullable|string|max:255',
        'linkedin' => 'nullable|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        $data = [
            'whatsapp' => $this->whatsapp,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
        ];

        if ($this->socialLinksId) {
            SocialLinks::find($this->socialLinksId)->update($data);
            session()->flash('success', 'Social links updated successfully!');
        } else {
            $social = SocialLinks::create($data);
            $this->socialLinksId = $social->id;
            session()->flash('success', 'Social links created successfully!');
        }
    }

    public function render()
    {
        return view('livewire.social-links-manager');
    }
}
