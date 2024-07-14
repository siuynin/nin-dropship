<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserManagement extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $userId;
    public $header = 'User Management';
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ];

    public function mount()
    {
        // Không cần load all users ở đây
    }

    public function createUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['name', 'email', 'password']);
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->userId,
        ]);

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->reset(['name', 'email', 'userId']);
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
    }

    public function render()
    {
        $users = User::paginate(10); // Thêm phân trang với 10 người dùng mỗi trang
        return view('livewire.admin-user-management', ['users' => $users, 'header' => $this->header]);
    }
}
