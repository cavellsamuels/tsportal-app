<?php

namespace App\Http\Controllers;

use App\Models\User;

class PageController extends Controller
{
    public function showDashboard()
    {
        $students = User::all()->where('role_id', 3);

        return view('dashboard', compact('students'));
    }
}
