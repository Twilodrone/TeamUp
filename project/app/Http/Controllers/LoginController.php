<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Импорт фасада Session
use App\Models\Employee;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Валидация входных данных
        $login = $request->input('login');
        $password = $request->input('password');

        // Поиск сотрудника по логину и паролю в базе данных
        $employee = Employee::where('login', $login)->where('password', $password)->first();

        if ($employee) {
            // Аутентификация прошла успешно
            return redirect()->route('menu', ['employee_id' => $employee->employee_id])->with('success', 'Вы успешно вошли в систему!');
    
        } else {
            // Неправильный логин или пароль
            return redirect()->back()->with('error', 'Неправильный логин или пароль');
        }
    }
    


    /**
     * Выход пользователя из приложения.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Удаление employee_id из сессии при выходе
        Session::forget('employee_id');

        // Выход текущего пользователя
        Auth::logout();

        // Перенаправление на главную страницу
        return redirect('/');
    }
}
