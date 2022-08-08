<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function fileUpload(Request $request)
    {

        if ($request->hasFile('file')) 
        {
            $path = $request->file('file')->store('public/files');
            $fileName = $request->file('file')->getClientOriginalName();
            $size = $request->file->getSize();

            $file = File::query()->create([
                'name' => $fileName,
                'path' => $path,
                'uploaded_by' => Auth::user()->id,
                'file_size' => $size,
            ]);

            FileUser::query()->create([
                'user_id' => $request->studentname,
                'file_id' => $file->id
            ]);
        } 
        else 
        {
            echo "Sorry, The File Does Not Exist";
            exit();
        }

        return redirect()->route('dashboard');
    }
}
