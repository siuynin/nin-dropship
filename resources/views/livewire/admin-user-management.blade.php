<div class="py-12">
    <div class="max-w-7xl py-12 mx-auto px-4 sm:px-6 lg:px-8 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4">User Management</h1>
        <form wire:submit.prevent="{{ $userId ? 'updateUser' : 'createUser' }}" class="mb-4">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" wire:model="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" wire:model="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            @if(!$userId)
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                <input type="password" wire:model="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            @endif
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ $userId ? 'Update' : 'Create' }}
            </button>
        </form>

        <h2 class="text-xl font-bold mb-4">Users List</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b-2 border-gray-300">Name</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300">Email</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">
                        <button wire:click="editUser({{ $user->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Edit</button>
                        <button wire:click="deleteUser({{ $user->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
<div class="py-12">