<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function showDashboard(File $file)
    {
        $students = User::all()->where('role_id', 1);
        $files = FileUser::all()->where('user_id', Auth::user()->id);

        return view('dashboard', compact('students', 'files', 'file'));
    }
}
