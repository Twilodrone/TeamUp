<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    // Метод для отображения всех команд
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }

    // Метод для отображения конкретной команды и ее файлов
    public function show($id)
    {
        // Получаем команду с участниками
        $team = Team::with('employees')->findOrFail($id);

        // Получаем путь к хранилищу из поля storage_path
        $storagePath = storage_path('app/' . $team->storage_path);

        // Проверяем, существует ли директория
        if (File::exists($storagePath)) {
            // Получаем все файлы в директории
            $files = File::files($storagePath);
        } else {
            $files = [];
        }

        // Возвращаем представление с данными команды и файлами
        return view('teams.show', compact('team', 'files'));
    }

    // Метод для скачивания файла
    public function download($id, $filename)
    {
        // Получаем команду
        $team = Team::findOrFail($id);

        // Формируем путь к файлу
        $filePath = storage_path('app/' . $team->storage_path . '/' . $filename);

        // Проверяем, существует ли файл
        if (File::exists($filePath)) {
            // Возвращаем файл для скачивания
            return response()->download($filePath);
        } else {
            // Если файл не найден, возвращаем сообщение об ошибке
            return back()->withErrors(['file_not_found' => 'Файл не найден']);
        }
    }

    // Метод для загрузки файла
    public function upload(Request $request, $id)
    {
        // Валидация загружаемого файла
        $request->validate([
            'file' => 'required|file',
        ]);

        // Получаем команду
        $team = Team::findOrFail($id);

        // Получаем файл
        $file = $request->file('file');

        // Перемещаем файл в хранилище команды
        $file->storeAs($team->storage_path, $file->getClientOriginalName());

        // Возвращаем обратно на страницу команды с сообщением об успешной загрузке
        return redirect()->route('teams.show', ['id' => $id])->with('success', 'Файл успешно загружен');
    }
    public function deleteFile($id, $filename)
    {
        // Получаем команду
        $team = Team::findOrFail($id);

        // Формируем путь к файлу
        $filePath = storage_path('app/' . $team->storage_path . '/' . $filename);

        // Проверяем, существует ли файл
        if (File::exists($filePath)) {
            // Удаляем файл
            File::delete($filePath);
            
            // Возвращаем обратно на страницу команды с сообщением об успешном удалении
            return redirect()->route('teams.show', ['id' => $id])->with('success', 'Файл успешно удален');
        } else {
            // Если файл не найден, возвращаем сообщение об ошибке
            return back()->withErrors(['file_not_found' => 'Файл не найден']);
        }
    }
}
