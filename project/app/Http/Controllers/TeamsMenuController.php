<?php
namespace App\Http\Controllers;
use App\Models\Team;
use App\Models\EmployeeToTeam;
use App\Models\Employee;
class TeamsMenuController extends Controller
{
    public function index($employee_id)
    {
        // Получаем команды, в которых состоит сотрудник
        $teams = Team::whereHas('employeeToTeam', function($query) use ($employee_id) {
            $query->where('employee_id', $employee_id);
        })->get();

        // Возвращаем представление с переданными данными
        return view('menu', ['teams' => $teams]);
    }
}
