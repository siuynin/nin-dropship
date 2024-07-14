<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\CategoryPost;

class PostCreate extends Component
{
    use WithFileUploads;

    public $title, $category_id, $newImage, $content, $seo_description, $seo_keyword;

    public function render()
    {
        return view('livewire.post-create', [
            'categories' => CategoryPost::all(),
        ]);
    }

    public function store()
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:category_post,id',
            'newImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'seo_description' => 'nullable|string|max:255',
            'seo_keyword' => 'nullable|string|max:255',
        ]);

        $imagePath = $this->newImage ? $this->newImage->store('images', 'public') : null;


        Post::create(array_merge($validatedData, ['image' => $imagePath]));

        session()->flash('message', 'Post Created Successfully.');

        return redirect()->route('admin.posts.index');
    }
}
