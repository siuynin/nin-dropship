<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\CategoryPost;

class AdminPost extends Component
{
    use WithFileUploads;

    public $posts, $title, $category_id, $image, $content, $seo_description, $seo_keyword, $slug;
    public $updateMode = false;
    public $postId;
    public $showModal = false;
    public $newImage;

    public function render()
    {
        $this->posts = Post::all();
        return view('livewire.admin-post', [
            'categories' => CategoryPost::all(),
        ]);
    }

    public function showCreateModal()
    {
        $this->resetInputFields();
        $this->updateMode = false;
        $this->showModal = true;
    }

    public function showEditModal($id)
    {
        $this->updateMode = true;
        $post = Post::findOrFail($id);
        $this->postId = $id;
        $this->title = $post->title;
        $this->slug = $post->slug;  
        $this->category_id = $post->category_id;
        $this->image = $post->image;
        $this->content = $post->content;
        $this->seo_description = $post->seo_description;
        $this->seo_keyword = $post->seo_keyword;
        $this->showModal = true;
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

        $imagePath = null;
        if ($this->newImage) {
            $imageName = time() . '.' . $this->newImage->getClientOriginalExtension();
            $this->newImage->storeAs('public/images', $imageName);
            $imagePath = 'images/' . $imageName;
        }

        Post::create(array_merge($validatedData, ['image' => $imagePath]));

        session()->flash('message', 'Post Created Successfully.');

        $this->resetInputFields();
        $this->showModal = false;
        $this->emit('postAdded');
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
        $imagePath = null;
        if ($this->newImage) {
            $imageName = time() . '.' . $this->newImage->getClientOriginalExtension();
            $this->newImage->storeAs('public/images', $imageName);
            $imagePath = 'images/' . $imageName;
        }

        $post->update(array_merge($validatedData, ['image' => $imagePath]));

        $this->updateMode = false;

        session()->flash('message', 'Post Updated Successfully.');

        $this->resetInputFields();
        $this->showModal = false;
        $this->emit('postUpdated');
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->category_id = '';
        $this->newImage = '';
        $this->content = '';
        $this->seo_description = '';
        $this->seo_keyword = '';
        $this->slug = '';  // Không cần reset slug
    }
}
