<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;  
use App\Models\CategoryPost;

class AdminCategoryPost extends Component
{
    use WithFileUploads;

    public $categories, $name, $image, $description, $seo_keyword, $seo_description;
    public $updateMode = false;
    public $categoryId;
    public $showModal = false;
    public $newImage;

    public function render()
    {
        $this->categories = CategoryPost::all();
        return view('livewire.admin-category-post');
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
        $categoryPost = CategoryPost::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $categoryPost->name;
        $this->image = $categoryPost->image;
        $this->description = $categoryPost->description;
        $this->seo_keyword = $categoryPost->seo_keyword;
        $this->seo_description = $categoryPost->seo_description;
        $this->showModal = true;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'newImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'seo_keyword' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
        ]);

        $imagePath = $this->newImage ? $this->newImage->store('images', 'public') : null;

        CategoryPost::create(array_merge($validatedData, ['image' => $imagePath]));

        session()->flash('message', 'Category Post Created Successfully.');

        $this->resetInputFields();
        $this->showModal = false;
        $this->emit('categoryPostAdded');
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'newImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'seo_keyword' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
        ]);

        $categoryPost = CategoryPost::find($this->categoryId);
        $imagePath = $this->newImage ? $this->newImage->store('images', 'public') : $categoryPost->image;

        $categoryPost->update(array_merge($validatedData, ['image' => $imagePath]));

        $this->updateMode = false;

        session()->flash('message', 'Category Post Updated Successfully.');

        $this->resetInputFields();
        $this->showModal = false;
        $this->emit('categoryPostUpdated');
    }

    public function delete($id)
    {
        CategoryPost::find($id)->delete();
        session()->flash('message', 'Category Post Deleted Successfully.');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->newImage = '';
        $this->description = '';
        $this->seo_keyword = '';
        $this->seo_description = '';
    }
}