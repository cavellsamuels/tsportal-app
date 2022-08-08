<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function download(File $file)
    {
        // dd($file);
        // $g = $file->file_size;
        // $g = Storage::size($file);
        // $file1 = $file->path;
        // dd($file1);

        if ($file) {

            try 
            {
                // return response()->download(storage_path("app/public/files/"), $file);

                return Storage::disk('public')->get("/files/$file");
            } 
            catch (QueryException $exception) 
            {
                return back()->with('error', 'Something Went Wrong');
            }
            return redirect()->route('dashboard');
        } else 
        {
            echo "File Doesnt Exist";
            die();
        }
    }
}
