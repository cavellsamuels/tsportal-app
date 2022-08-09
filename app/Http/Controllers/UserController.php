<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileUser;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function showDashboard(File $file)
    {
        $students = User::all()->where('role_id', 1);
        $files = FileUser::all()->where('user_id', Auth::user()->id);

        return view('dashboard', compact('students', 'files', 'file'));
    }

    public function fileUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('public/files');
            $fileName = $request->file('file')->getClientOriginalName();
            $uploadedBy = Auth::user()->id;
            $size = $request->file->getSize();

            $file = File::query()->create([
                'name' => $fileName,
                'path' => $path,
                'uploaded_by' => $uploadedBy,
                'file_size' => $size,
            ]);

            FileUser::query()->create([
                'user_id' => $request->studentname,
                'file_id' => $file->id,
            ]);
        } else {
            echo 'Sorry, The File Does Not Exist';
            exit();
        }

        return redirect()->route('dashboard');
    }

    public function fileDownload(File $file)
    {
        if ($file) {
            try {
                Storage::download($file->path, $file->name);
            } catch (QueryException $exception) {
                return back()->with('error', 'Something Went Wrong');
            }

            return redirect()->route('dashboard');
        } else {
            echo 'File Doesnt Exist';
            exit();
        }
    }
}
