<!-- resources/views/livewire/category-product-item.blade.php -->

<div class="ml-{{ $category->parent_id ? '4' : '0' }}">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            @if ($category->image)
                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="h-10 w-10 object-cover rounded-full mr-2">
            @else
                <div class="h-10 w-10 bg-gray-200 rounded-full mr-2"></div>
            @endif
            <span class="font-semibold">{{ $category->name }}</span>
        </div>
        <div class="flex items-center">
            <button wire:click="edit({{ $category->id }})" class="bg-blue-500 text-white px-4 py-1 rounded mr-2">Edit</button>
            <button wire:click="delete({{ $category->id }})" class="bg-red-500 text-white px-4 py-1 rounded">Delete</button>
        </div>
    </div>

    @if($category->children->isNotEmpty())
        <div class="ml-4 mt-2">
            @foreach($category->children as $child)
                @include('livewire.category-product-item', ['category' => $child])
            @endforeach
        </div>
    @endif
</div>
