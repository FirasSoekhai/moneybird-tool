<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class AdminDashboardController extends Controller
{
    public function index()
{
    $users = User::where('is_approved', false)->get();

    return Inertia::render('Admin/ApproveUsers', [
        'users' => $users,
    ]);
}
}
