<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function list(Request $request)
    {
        // Валидация входного параметра
        $request->validate([
            'path' => 'required|string',
        ]);

        $path = $request->input('path');
        
        // Проверяем, существует ли указанный путь
        if (!Storage::exists($path)) {
            return response()->json(['error' => 'Path not found'], 404);
        }
        
        // Получаем список файлов в указанной директории
        try {
            $files = Storage::files($path);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to retrieve files', 'message' => $e->getMessage()], 500);
        }
        
        return response()->json(['files' => $files]);
    }

    public function upload(Request $request)
    {
        $path = $request->input('path');
        
        // Проверяем, существует ли указанный путь
        if (!Storage::exists($path)) {
            return response()->json(['error' => 'Path not found'], 404);
        }
        
        // Проверяем, загружен ли файл
        if ($request->hasFile('file')) {
            // Загружаем файл
            $uploadedFile = $request->file('file');
            $fileName = $uploadedFile->getClientOriginalName();
            $uploadedFile->storeAs($path, $fileName);
            
            return response()->json(['message' => 'File uploaded successfully']);
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    }
    
    public function download(Request $request)
    {
        $path = $request->input('path');
        
        // Проверяем, существует ли указанный путь
        if (!Storage::exists($path)) {
            return response()->json(['error' => 'Path not found'], 404);
        }
        
        // Проверяем, существует ли файл
        if (!Storage::exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }
        
        // Возвращаем файл пользователю
        return response()->download(storage_path("app/$path"));
    }

    public function delete(Request $request)
    {
        $path = $request->input('path');
        
        // Проверяем, существует ли указанный путь
        if (!Storage::exists($path)) {
            return response()->json(['error' => 'Path not found'], 404);
        }
        
        // Удаляем файл
        Storage::delete($path);
        
        return response()->json(['message' => 'File deleted successfully']);
    }
}

