<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('fileToUpload')) {
            $file = $request->file('fileToUpload');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            return 'File uploaded successfully.';
        } else {
            return 'No file uploaded.';
        }
    }
}

