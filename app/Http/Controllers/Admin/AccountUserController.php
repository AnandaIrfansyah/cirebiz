<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AccountUserController extends Controller
{
    public function index()
    {
        $roles = ['user', 'umkm'];
        $usersByRole = [];

        foreach ($roles as $role) {
            $usersByRole[$role] = User::role($role)->paginate(10, ['*'], $role . '_page');
        }

        $allRoles = Role::pluck('name')->toArray();

        return view('pages.admin.dataPengguna.accountUser.index', [
            'roles' => $roles,
            'usersByRole' => $usersByRole,
            'allRoles' => $allRoles
        ]);
    }
}
