<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function fileUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->store('public/files');

            $file = File::create([
                'name' => $fileName,
                'path' => $path,
                'uploaded_by' => Auth::user()->name,
            ]);
        }
    }

    public function associateFile(Request $request)
    {
        $student = $request->get('studentname');

        $file = $this->fileUpload($request);

        return back()->withErrors('File Successfully Uploaded');
    }

    public function index()
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
