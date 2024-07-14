@if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
             role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-semibold mb-4">Edit Post</h2>
        <form wire:submit.prevent="update" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" wire:model.defer="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" />
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="category_id" wire:model.defer="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="newImage" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" id="newImage" wire:model="newImage" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" />
                @error('newImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @if($image)
                    <img src="{{ Storage::url($image) }}" alt="Current Image" class="mt-2 w-32 h-32">
                @endif
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea id="content" wire:model.defer="content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm"></textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="seo_description" class="block text-sm font-medium text-gray-700">SEO Description</label>
                <textarea id="seo_description" wire:model.defer="seo_description" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm"></textarea>
                @error('seo_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="seo_keyword" class="block text-sm font-medium text-gray-700">SEO Keyword</label>
                <input type="text" id="seo_keyword" wire:model.defer="seo_keyword" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" />
                @error('seo_keyword') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Save</button>
            </div>
        </form>
    </div>
</div>