<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersManagementController extends Controller
{
    public function usersManagement() {
        $user = new User();
        $users = $user->all();
        return view('admin.users.index', compact('users'));
    }
}
