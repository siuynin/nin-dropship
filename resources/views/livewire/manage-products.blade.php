<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <h1 class="text-2xl font-bold mb-4">Manage Products</h1>

    <button wire:click="create()" class="bg-green-500 text-white px-4 py-2 rounded mb-4">Create Product</button>

    @if(session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="table-auto w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2">Image</th> 
                <th class="px-4 py-2">Product Name</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Sell Price</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td class="border px-4 py-2"> 
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->product_name }}" class="h-10 w-10 object-cover rounded-full mr-2">
                        @else
                            <img src="{{ $product->image_url }}" class="h-10 w-10 object-cover rounded-full">
                        @endif
                    </td> 
                    <td class="border px-4 py-2">{{ $product->product_name }}</td>
                    <td class="border px-4 py-2">{{ $product->category->name }}</td>
                    <td class="border px-4 py-2">{{ $product->sell_price }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $product->id }})" class="bg-blue-500 text-white px-4 py-1 rounded mr-2">Edit</button>
                        <button wire:click="delete({{ $product->id }})" class="bg-red-500 text-white px-4 py-1 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($isModalOpen)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form>
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div>
                                <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
                                <input type="text" wire:model="product_name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                                @error('product_name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                                <select wire:model="category_id" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="sell_price" class="block text-sm font-medium text-gray-700">Sell Price</label>
                                <input type="text" wire:model="sell_price" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                                @error('sell_price') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="prev_price" class="block text-sm font-medium text-gray-700">Previous Price</label>
                                <input type="text" wire:model="prev_price" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                <input type="file" wire:model="image" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="image_url" class="block text-sm font-medium text-gray-700">Image URL</label>
                                <input type="text" wire:model="image_url" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="video_url" class="block text-sm font-medium text-gray-700">Video URL</label>
                                <input type="text" wire:model="video_url" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="sourceFrom" class="block text-sm font-medium text-gray-700">Source From</label>
                                <input type="text" wire:model="sourceFrom" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                                <textarea wire:model="content" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
                            </div>
                            <div>
                                <label for="seo_keywords" class="block text-sm font-medium text-gray-700">SEO Keywords</label>
                                <input type="text" wire:model="seo_keywords" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="seo_meta" class="block text-sm font-medium text-gray-700">SEO Meta</label>
                                <input type="text" wire:model="seo_meta" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button wire:click.prevent="store()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                Save
                            </button>
                            <button wire:click="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>