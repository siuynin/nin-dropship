<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-4">Manage Category Products</h1>

    <button wire:click="create()" class="bg-green-500 x-4 py-2 rounded mb-4">Create Category Product</button>

    <div class="bg-white">
        @foreach($categoryProducts as $category)
            @include('livewire.category-product-item', ['category' => $category])
        @endforeach
    </div>

    @if($isOpen)
        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
            <div class="flex justify-center items-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form wire:submit.prevent="store">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                        {{ $categoryId ? 'Edit Category Product' : 'Create Category Product' }}
                                    </h3>
                                    <div class="mt-2">
                                        <div class="mt-4">
                                            <input type="text" wire:model="name" placeholder="Name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mt-4">
                                            <input type="text" wire:model="slug" placeholder="Cat_Id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            @error('slug') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mt-4">
                                            <input type="file" wire:model="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            @error('image') <span class="text-red-500">{{ $message }}</span> @enderror

                                            @if ($image instanceof \Livewire\TemporaryUploadedFile)
                                                <img src="{{ $image->temporaryUrl() }}" class="h-16 w-16 object-cover mt-2">
                                            @elseif ($image)
                                                <img src="{{ Storage::url($image) }}" class="h-16 w-16 object-cover mt-2">
                                            @endif
                                        </div>
                                        <div class="mt-4">
                                            <textarea wire:model="content" id="content" placeholder="Content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                                            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mt-4">
                                            <input type="text" wire:model="seo_meta" placeholder="SEO Meta" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            @error('seo_meta') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mt-4">
                                            <input type="text" wire:model="seo_keywords" placeholder="SEO Keywords" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            @error('seo_keywords') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mt-4">
                                            <label for="parent_id" class="block text-sm font-medium leading-5 text-gray-700">Parent Category</label>
                                            <select wire:model="parentId" id="parent_id" class="form-select mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                                                <option value="">None</option>
                                                @foreach($categoryProducts as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('parent_id') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Save
                                </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Cancel
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:load', function () {
        CKEDITOR.replace('content');
        CKEDITOR.instances.content.on('change', function () {
            @this.set('content', CKEDITOR.instances.content.getData());
        });
    });
</script>
