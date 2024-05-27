<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $primaryKey = 'team_id';
    public function employeeToTeam()
    {
        return $this->hasMany(EmployeeToTeam::class, 'team_id', 'team_id');
    }
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_to_team', 'team_id', 'employee_id');
    }
}
