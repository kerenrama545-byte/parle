<?php

namespace App\Livewire;

use App\Models\SeoMetadata;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageSeoMetadata extends Component
{
    use WithFileUploads, WithPagination;

    public $selectedPage = null;

    public $page_name;

    public $meta_title;

    public $meta_description;

    public $og_image;

    public $og_image_file;

    public $canonical_url;

    public $structured_data;

    public $showModal = false;

    public $isEditing = false;

    public $search = '';

    protected $rules = [
        'page_name' => 'required|string|unique:seo_metadata,page_name',
        'meta_title' => 'required|string|max:60',
        'meta_description' => 'required|string|max:160',
        'og_image' => 'nullable|string',
        'og_image_file' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'canonical_url' => 'nullable|url',
        'structured_data' => 'nullable|json',
    ];

    protected $messages = [
        'meta_title.max' => 'Meta title should not exceed 60 characters.',
        'meta_description.max' => 'Meta description should not exceed 160 characters.',
        'structured_data.json' => 'Structured data must be valid JSON.',
    ];

    public function render()
    {
        $seoPages = SeoMetadata::when($this->search, function ($query) {
            return $query->where('page_name', 'like', '%'.$this->search.'%')
                ->orWhere('meta_title', 'like', '%'.$this->search.'%')
                ->orWhere('meta_description', 'like', '%'.$this->search.'%');
        })
            ->orderBy('page_name')
            ->paginate(10);

        return view('livewire.manage-seo-metadata', ['seoPages' => $seoPages]);
    }

    public function create()
    {
        $this->reset(['page_name', 'meta_title', 'meta_description', 'og_image', 'og_image_file', 'canonical_url', 'structured_data']);
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $seoMetadata = SeoMetadata::findOrFail($id);

        $this->selectedPage = $id;
        $this->page_name = $seoMetadata->page_name;
        $this->meta_title = $seoMetadata->meta_title;
        $this->meta_description = $seoMetadata->meta_description;
        $this->og_image = $seoMetadata->og_image;
        $this->canonical_url = $seoMetadata->canonical_url;
        $this->structured_data = $seoMetadata->structured_data;

        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        // Update validation rules for edit mode
        if ($this->isEditing) {
            $this->rules['page_name'] = 'required|string|unique:seo_metadata,page_name,'.$this->selectedPage;
        }

        $this->validate();

        // Handle file upload
        $ogImagePath = $this->og_image;

        if ($this->og_image_file) {
            // Store the file in the 'seo-images' directory
            $ogImagePath = $this->og_image_file->store('seo-images', 'public');
        }

        $data = [
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'og_image' => $ogImagePath,
            'canonical_url' => $this->canonical_url,
            'structured_data' => $this->structured_data,
        ];

        if ($this->isEditing) {
            $seoMetadata = SeoMetadata::findOrFail($this->selectedPage);
            $seoMetadata->update(array_merge(['page_name' => $this->page_name], $data));
            session()->flash('message', 'SEO metadata updated successfully!');
        } else {
            SeoMetadata::create(array_merge(['page_name' => $this->page_name], $data));
            session()->flash('message', 'SEO metadata created successfully!');
        }

        $this->showModal = false;
        $this->reset(['page_name', 'meta_title', 'meta_description', 'og_image', 'og_image_file', 'canonical_url', 'structured_data']);
    }

    public function delete($id)
    {
        $seoMetadata = SeoMetadata::findOrFail($id);
        $seoMetadata->delete();

        session()->flash('message', 'SEO metadata deleted successfully!');
    }

    public function getCharCount($field)
    {
        return strlen($this->{$field});
    }

    public function getRecommendations($field)
    {
        switch ($field) {
            case 'meta_title':
                return [
                    'min' => 30,
                    'max' => 60,
                    'optimal' => 50,
                ];
            case 'meta_description':
                return [
                    'min' => 70,
                    'max' => 160,
                    'optimal' => 150,
                ];
            default:
                return [];
        }
    }
}
