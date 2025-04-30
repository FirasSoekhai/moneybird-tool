<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('isVerified', false)->get();

        return inertia('Admin/ApproveUsers', [
            'users' => $users
        ]);
    }

    // Goedkeuren van een user
    public function approve(User $user): RedirectResponse
    {
        $user->isVerified = true;
        $user->save();

        return redirect()->back()->with('success', 'Gebruiker goedgekeurd.');
    }
    
    public function makeadmin(User $user): RedirectResponse
    {
        $user->is_admin = true;
        $user->save();
        return redirect()->back()->with('success', 'Gebruiker admin gemaakt');
    }
}
