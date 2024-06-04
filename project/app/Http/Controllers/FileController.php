<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FileController extends Controller
{
    public function list(Request $request)
    {
        $response = Http::get('http://127.0.0.1:8080/list', ['path' => $request->input('path')]);

        if ($response->successful()) {
            return $response;
        } else {
            return response()->json(['files' => []], 404);
        }
    }

    public function upload(Request $request)
    {
        $response = Http::attach('file', $request->file('file'), $request->file('file')->getClientOriginalName())
                        ->get('http://127.0.0.1:8080/upload', ['path' => $request->input('path')]);

        if ($response->successful()) {
            return $response;
        } else {
            return response()->json(['message' => 'Failed to upload file'], 500);
        }
    }

    public function download(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8080/download', ['path' => $request->input('path')]);

        if ($response->successful()) {
            return response()->streamDownload(function() use ($response) {
                echo $response->body();
            }, basename($request->input('path')));
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    public function delete(Request $request)
    {
        $response = Http::delete('http://127.0.0.1:8080/delete', ['path' => $request->input('path')]);

        if ($response->successful()) {
            return $response;
        } else {
            return response()->json(['error' => 'Failed to delete file'], 500);
        }
    }
}