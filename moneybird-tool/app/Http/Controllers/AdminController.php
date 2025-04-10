<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        
        $users = User::all();
        
        return Inertia::render('Admin/Dashboard', [
            'users' => $users,
        ]);
    }

    public function toggleAdmin(Request $request, User $user)
    {

    // Check of de gebruiker al een admin is
    $isAdmin = $user->admin();

    if ($isAdmin) {
        // Verwijder admin rechten
        $user->admin()->delete();
        $message = 'Admin rechten verwijderd voor ' . $user->username;
    } else {
        // Maak gebruiker admin
        $admin = new Admin();
        $admin->user_id = $user->user_id;
        $admin->admin_id = Admin::max('admin_id') + 1;
        $admin->admin_level = $request->input('admin_level', 1); // Standaard level 1
        $admin->save();
        $message = $user->username . ' is nu admin met level ' . $admin->admin_level;
    }

    return redirect()->back()->with('message', $message);
    }
}