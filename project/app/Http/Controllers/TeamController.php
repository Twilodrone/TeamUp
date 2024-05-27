<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }

    public function show($id)
    {
        // Получаем команду с участниками
        $team = Team::with('employees')->findOrFail($id);

        // Возвращаем представление с данными команды
        return view('teams.show', compact('team'));
    }
}
