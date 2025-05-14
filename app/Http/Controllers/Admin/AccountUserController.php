<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccountUserController extends Controller
{
    public function index()
    {
        $users = User::role('user')->paginate(10);
        return view('pages.admin.dataPengguna.accountUser.index', compact('users'));
    }
}
