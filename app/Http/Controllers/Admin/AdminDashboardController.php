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
        // Haalt alle gebruikers op waarvan 'is_approved' gelijk is aan false
        $users = User::where('is_approved', false)->get();

        // Retourneert de Inertia view met de gebruikerslijst op de 'Admin/ApproveUsers' pagina
        return Inertia::render('Admin/ApproveUsers', [
            'users' => $users,
        ]);
    }
}
