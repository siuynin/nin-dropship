<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\CategoryProduct;

class ManageProducts extends Component
{
    use WithFileUploads;

    public $products, $categories, $productId, $sku_parents, $product_name, $image, $image_url, $category_id, $sell_price, $prev_price, $video_url, $sourceFrom, $content, $seo_keywords, $seo_meta;
    public $isModalOpen = 0;

    public function render()
    {
        $this->products = Product::with('category')->get();
        $this->categories = CategoryProduct::all();
        return view('livewire.manage-products');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->sku_parents = '';
        $this->product_name = '';
        $this->image = '';
        $this->image_url = '';
        $this->category_id = '';
        $this->sell_price = '';
        $this->prev_price = '';
        $this->video_url = '';
        $this->sourceFrom = '';
        $this->content = '';
        $this->seo_keywords = '';
        $this->seo_meta = '';
        $this->productId = '';
    }

    public function store()
    {
        $this->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'sell_price' => 'required|numeric',
        ]);

        $imageName = $this->image ? $this->image->store('products', 'public') : null;

        Product::updateOrCreate(['id' => $this->productId], [
            'sku_parents' => $this->sku_parents,
            'product_name' => $this->product_name,
            'image' => $imageName,
            'image_url' => $this->image_url,
            'category_id' => $this->category_id,
            'sell_price' => $this->sell_price,
            'prev_price' => $this->prev_price,
            'video_url' => $this->video_url,
            'sourceFrom' => $this->sourceFrom,
            'content' => $this->content,
            'seo_keywords' => $this->seo_keywords,
            'seo_meta' => $this->seo_meta,
        ]);

        session()->flash('message', $this->productId ? 'Product updated successfully.' : 'Product created successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $id;
        $this->sku_parents = $product->sku_parents;
        $this->product_name = $product->product_name;
        $this->image_url = $product->image_url;
        $this->category_id = $product->category_id;
        $this->sell_price = $product->sell_price;
        $this->prev_price = $product->prev_price;
        $this->video_url = $product->video_url;
        $this->sourceFrom = $product->sourceFrom;
        $this->content = $product->content;
        $this->seo_keywords = $product->seo_keywords;
        $this->seo_meta = $product->seo_meta;

        $this->openModal();
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Product deleted successfully.');
    }
}
