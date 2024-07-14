<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\CategoryPost;

class PostEdit extends Component
{
    use WithFileUploads;

    public $postId, $title, $category_id, $newImage, $image, $content, $seo_description, $seo_keyword;

    public function mount($id)
    {
        $post = Post::findOrFail($id);
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->category_id = $post->category_id;
        $this->image = $post->image;
        $this->content = $post->content;
        $this->seo_description = $post->seo_description;
        $this->seo_keyword = $post->seo_keyword;
    }

    public function render()
    {
        return view('livewire.post-edit', [
            'categories' => CategoryPost::all(),
        ]);
    }

    public function update()
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:category_post,id',
            'newImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'seo_description' => 'nullable|string|max:255',
            'seo_keyword' => 'nullable|string|max:255',
        ]);

        $post = Post::find($this->postId);
        
        $imagePath = $this->newImage ? $this->newImage->store('images', 'public') : $post->image;

        $post->update(array_merge($validatedData, ['image' => $imagePath]));

        session()->flash('message', 'Post Updated Successfully.');

        return redirect()->route('admin.posts.index');
    }
}
