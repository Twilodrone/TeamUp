<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    public function show($id)
    {
        $team = Team::with('employees')->findOrFail($id);
        $storagePath = $team->storage_path;

        try {
            $response = Http::get('http://127.0.0.1:8080/list', ['path' => $storagePath]);

            if ($response->successful()) {
                $files = $response->json()['files'];
            } else {
                $files = [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching files from microservice: ' . $e->getMessage());
            $files = [];
        }

        return view('teams.show', compact('team', 'files'));
    }

    public function download($id, $filename)
    {
        $team = Team::findOrFail($id);
        $filePath = $team->storage_path . '/' . $filename;

        try {
            $response = Http::get('http://127.0.0.1:8080/download', ['path' => $filePath]);

            if ($response->successful()) {
                return response()->streamDownload(function() use ($response) {
                    echo $response->body();
                }, $filename);
            } else {
                return back()->withErrors(['file_not_found' => 'Файл не найден']);
            }
        } catch (\Exception $e) {
            Log::error('Error downloading file from microservice: ' . $e->getMessage());
            return back()->withErrors(['file_not_found' => 'Файл не найден']);
        }
    }

    public function upload(Request $request, $id)
{
    $request->validate([
        'file' => 'required|file',
    ]);

    $team = Team::findOrFail($id);
    $file = $request->file('file');
    $filePath = $team->storage_path;

    try {
        // Отправляем запрос к микросервису
        $response = Http::attach('file', file_get_contents($file->getPathname()), $file->getClientOriginalName())
            ->post('http://127.0.0.1:8080/upload', [
                'path' => $filePath
            ]);

        if ($response->successful()) {
            return redirect()->route('teams.show', ['id' => $id])->with('success', 'Файл успешно загружен');
        } else {
            // Логируем статус ответа и тело
            Log::error('Microservice response error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return back()->withErrors(['upload_failed' => 'Ошибка ответа микросервиса: ' . $response->body()]);
        }
    } catch (\Exception $e) {
        // Логируем исключение
        Log::error('Error uploading file to microservice: ' . $e->getMessage());
        return back()->withErrors(['upload_failed' =>$e->getMessage()]);
    }
}

public function deleteFile(Request $request, $id, $filename)
{
    $team = Team::findOrFail($id);
    $filePath = $team->storage_path . '/' . $filename;

    try {
        // Отправляем запрос к микросервису для удаления файла
        $response = Http::delete('http://127.0.0.1:8080/delete', [
            'path' => $filePath
        ]);

        if ($response->successful()) {
            return redirect()->route('teams.show', ['id' => $id])->with('success', 'Файл успешно удален');
        } else {
            // Логируем статус ответа и тело
            Log::error('Microservice response error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return back()->withErrors(['delete_failed' => 'Ошибка ответа микросервиса: ' . $response->body()]);
        }
    } catch (\Exception $e) {
        // Логируем исключение
        Log::error('Error deleting file from microservice: ' . $e->getMessage());
        return back()->withErrors(['delete_failed' => $e->getMessage()]);
    }
}

}



