<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Posts</h1>
        <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Create Post</a>
    </div>

    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
             role="alert">
            {{ session('message') }}
        </div>
    @endif

    <table class="min-w-full bg-white shadow-md rounded-lg">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Title</th>
                <th class="py-2 px-4 border-b">Category</th>
                <th class="py-2 px-4 border-b">Image</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $post->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $post->title }}</td>
                    <td class="py-2 px-4 border-b">{{ $post->category->name }}</td>
                    <td class="py-2 px-4 border-b">
                        @if($post->image)
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-16 h-16">
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('posts.edit', $post->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Edit</a>
                        <button wire:click="delete({{ $post->id }})" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
