<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Menu;
use Illuminate\Support\Facades\File;

class MenuManager extends Component
{
    use WithFileUploads;

    public $menus;
    public $menuId;

    // Header
    public $title;
    public $quote;

    // Menu Item
    public $name;
    public $description;
    public $price;
    public $image;
    public $oldImage;

    public $isEdit = false;

    public function mount()
    {
        // Load header
        $header = Menu::whereNull('name')->first();
        if ($header) {
            $this->title = $header->title;
            $this->quote = $header->quote;
        }

        $this->loadMenus();
    }

    public function loadMenus()
    {
        $this->menus = Menu::whereNotNull('name')->latest()->get();
    }

    /* ================= HEADER ================= */
    public function saveHeader()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'quote' => 'nullable|string|max:255',
        ]);

        $header = Menu::whereNull('name')->first();

        if ($header) {
            $header->update([
                'title' => $this->title,
                'quote' => $this->quote,
            ]);
        } else {
            Menu::create([
                'title' => $this->title,
                'quote' => $this->quote,
                'name'  => null,
                'price' => null,
            ]);
        }

        session()->flash('success', 'Menu header berhasil disimpan');
    }

    /* ================= STORE MENU ================= */
    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ];

        if ($this->image) {
            $filename = 'menu_' . time() . '.' . $this->image->getClientOriginalExtension();
            $this->saveImageToPublic($this->image, $filename);
            $data['image'] = $filename;
        }

        Menu::create($data);

        $this->resetForm();
        $this->loadMenus();
        session()->flash('success', 'Menu berhasil ditambahkan');
    }

    /* ================= EDIT ================= */
    public function edit(Menu $menu)
    {
        $this->menuId = $menu->id;
        $this->name = $menu->name;
        $this->description = $menu->description;
        $this->price = $menu->price;
        $this->oldImage = $menu->image;
        $this->isEdit = true;
    }

    /* ================= UPDATE ================= */
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $menu = Menu::findOrFail($this->menuId);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ];

        if ($this->image) {
            if ($menu->image && File::exists(public_path('menu/'.$menu->image))) {
                File::delete(public_path('menu/'.$menu->image));
            }
            $filename = 'menu_' . time() . '.' . $this->image->getClientOriginalExtension();
            $this->saveImageToPublic($this->image, $filename);
            $data['image'] = $filename;
        }

        $menu->update($data);

        $this->resetForm();
        $this->loadMenus();
        session()->flash('success', 'Menu berhasil diupdate');
    }

    /* ================= DELETE ================= */
    public function delete($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->image && File::exists(public_path('menu/'.$menu->image))) {
            File::delete(public_path('menu/'.$menu->image));
        }

        $menu->delete();
        $this->loadMenus();
        session()->flash('success', 'Menu berhasil dihapus');
    }

    /* ================= RESET FORM ================= */
    public function resetForm()
    {
        $this->reset([
            'menuId',
            'name',
            'description',
            'price',
            'image',
            'oldImage',
            'isEdit',
        ]);
    }

    /* ================= HELPER FUNCTION ================= */
    private function saveImageToPublic($image, $filename)
    {
        // Pastikan folder public/menu ada
        if (!file_exists(public_path('menu'))) {
            mkdir(public_path('menu'), 0755, true);
        }
        // Pindahkan file upload ke public/menu
        $image->storeAs('', $filename, 'public');
        $source = $image->getRealPath();
        $destination = public_path('menu/' . $filename);
        copy($source, $destination);
    }

    /* ================= RENDER ================= */
    public function render()
    {
        return view('livewire.menu-manager');
    }
}
