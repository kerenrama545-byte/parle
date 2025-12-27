<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Blog;
use Illuminate\Support\Facades\File;

class BlogManager extends Component
{
    use WithFileUploads;

    public $blogId;
    public $title;
    public $excerpt;
    public $content;
    public $image;
    public $oldImage;
    public $published_at;

    public $blogs; // daftar semua blog

    public function mount()
    {
        $this->loadBlogs();
    }

    public function loadBlogs()
    {
        $this->blogs = Blog::orderBy('created_at', 'desc')->get();
    }

    public function resetForm()
    {
        $this->blogId = null;
        $this->title = '';
        $this->excerpt = '';
        $this->content = '';
        $this->image = null;
        $this->oldImage = null;
        $this->published_at = null;
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $this->blogId = $blog->id;
        $this->title = $blog->title;
        $this->excerpt = $blog->excerpt;
        $this->content = $blog->content;
        $this->oldImage = $blog->image;
        $this->published_at = $blog->published_at;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $blog = $this->blogId ? Blog::find($this->blogId) : new Blog();

        /* ===== SIMPAN IMAGE LANGSUNG KE PUBLIC ===== */
        if ($this->image) {
            $folder = public_path('blog');

            if (!File::exists($folder)) {
                mkdir($folder, 0755, true);
            }

            // Hapus image lama jika ada
            if ($blog->image && File::exists(public_path('blog/' . $blog->image))) {
                File::delete(public_path('blog/' . $blog->image));
            }

            $filename = 'blog_' . time() . '.' . $this->image->getClientOriginalExtension();
            $this->saveImageToPublic($this->image, $filename);

            $blog->image = $filename;
        }

        $blog->title = $this->title;
        $blog->excerpt = $this->excerpt;
        $blog->content = $this->content;
        $blog->published_at = $this->published_at;
        $blog->save();

        $this->resetForm();
        $this->loadBlogs();

        session()->flash('success', 'Blog berhasil disimpan');
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image && File::exists(public_path('blog/' . $blog->image))) {
            File::delete(public_path('blog/' . $blog->image));
        }

        $blog->delete();
        $this->loadBlogs();
        session()->flash('success', 'Blog berhasil dihapus');
    }

    private function saveImageToPublic($image, $filename)
    {
        // Pastikan folder public/blog ada
        if (!file_exists(public_path('blog'))) {
            mkdir(public_path('blog'), 0755, true);
        }

        // Simpan sementara Livewire
        $image->storeAs('', $filename, 'public');
        // Copy ke public/blog
        copy($image->getRealPath(), public_path('blog/' . $filename));
    }

    public function render()
    {
        return view('livewire.blog-manager');
    }
}
