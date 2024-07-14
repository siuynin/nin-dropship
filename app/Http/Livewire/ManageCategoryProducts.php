<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CategoryProduct;
use Illuminate\Support\Str;

class ManageCategoryProducts extends Component
{
    use WithFileUploads;

    public $categoryProducts, $name, $slug, $image, $parentId, $content, $seo_keywords, $seo_meta, $categoryId;
    public $isOpen = false;

    public function mount()
    {
        $this->categoryProducts = CategoryProduct::with('children')->whereNull('parent_id')->get();
    }

    public function render()
    {
        return view('livewire.manage-category-products', [
            'categoryProducts' => $this->categoryProducts,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function edit($id)
    {
        $categoryProduct = CategoryProduct::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $categoryProduct->name;
        $this->slug = $categoryProduct->slug;
        $this->image = $categoryProduct->image;
        $this->parentId = $categoryProduct->parent_id;
        $this->content = $categoryProduct->content;
        $this->seo_keywords = $categoryProduct->seo_keywords;
        $this->seo_meta = $categoryProduct->seo_meta;

        $this->openModal();
    }

    public function delete($id)
    {
        CategoryProduct::find($id)->delete();
        session()->flash('message', 'Category Product deleted successfully.');
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->slug = '';
        $this->image = '';
        $this->parentId = null;
        $this->content = '';
        $this->seo_keywords = '';
        $this->seo_meta = '';
        $this->categoryId = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:category_products,slug,' . $this->categoryId,
            'image' => 'nullable|image|max:1024',
        ]);

        if ($this->image instanceof \Livewire\TemporaryUploadedFile) {
            $imagePath = $this->image->store('images', 'public');
        } else {
            $imagePath = $this->image;
        }

        CategoryProduct::updateOrCreate(['id' => $this->categoryId], [
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $imagePath,
            'parent_id' => $this->parentId,
            'content' => $this->content,
            'seo_keywords' => $this->seo_keywords,
            'seo_meta' => $this->seo_meta,
        ]);

        session()->flash('message', $this->categoryId ? 'Category Product updated successfully.' : 'Category Product created successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }
}
