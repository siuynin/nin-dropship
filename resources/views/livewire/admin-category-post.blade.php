<div class="py-12">
    <div class="max-w-7xl py-12 mx-auto px-4 sm:px-6 lg:px-8 p-6 bg-white shadow-md rounded-lg">
        <div class="flex flex-wrap">
            <div class=" ">
                @if (session()->has('message'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                        role="alert">
                        {{ session('message') }}
                    </div>
                @endif 
                <button wire:click="showCreateModal" class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-lg">
                    Create Category Post
                </button>
                <table class="min-w-full mt-4 bg-white divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th> 
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($categories as $categoryPost)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $categoryPost->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $categoryPost->slug }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($categoryPost->image)
                                        <img src="{{ asset('storage/' . $categoryPost->image) }}" width="100" alt="Image" class="rounded-lg">
                                    @else
                                        <span class="text-gray-400">No Image</span>
                                    @endif
                                </td> 
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button wire:click="showEditModal({{ $categoryPost->id }})" class="text-yellow-500 hover:text-yellow-700">Edit</button>
                                    <button wire:click="delete({{ $categoryPost->id }})" class="text-red-500 hover:text-red-700 ml-4">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class=" ">
                <!-- Modal -->
                <div x-data="{ open: @entangle('showModal') }" x-show="open" @keydown.escape.window="open = false" class=" inset-0 z-10 overflow-y-auto bg-gray-500 bg-opacity-75 ">
                    <div class="bg-white rounded-lg  p-6">
                        <h2 class="text-xl font-semibold mb-4">{{ $updateMode ? 'Edit' : 'Create' }} Category Post</h2>
                        <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" id="name" wire:model.defer="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" />
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label for="newImage" class="block text-sm font-medium text-gray-700">Image</label>
                                <input type="file" id="newImage" wire:model="newImage" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" />
                                @error('newImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                @if ($updateMode && $image)
                                    <div class="mt-2">
                                        <p class="text-gray-600 text-sm">Current Image:</p>
                                        <img src="{{ asset('storage/' . $image) }}" width="100" alt="Current Image" class="rounded-lg mt-1">
                                    </div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" wire:model.defer="description" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm"></textarea>
                                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label for="seo_keyword" class="block text-sm font-medium text-gray-700">SEO Keyword</label>
                                <input type="text" id="seo_keyword" wire:model.defer="seo_keyword" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" />
                                @error('seo_keyword') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label for="seo_description" class="block text-sm font-medium text-gray-700">SEO Description</label>
                                <textarea id="seo_description" wire:model.defer="seo_description" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm"></textarea>
                                @error('seo_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="button" @click="open = false" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">{{ $updateMode ? 'Update' : 'Save' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>