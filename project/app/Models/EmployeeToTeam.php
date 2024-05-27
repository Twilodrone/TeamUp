<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeToTeam extends Model
{
    protected $table = 'employee_to_team'; // Указание таблицы, если имя не стандартное
    public $incrementing = false;
    public $timestamps = false;

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }
}