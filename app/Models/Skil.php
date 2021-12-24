<?php

namespace App\Models;
//namespace App;

//use App\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skil extends Model
{
    use HasFactory;
    protected $table = "skils";
    /**
     * The emp that belong to the emp.
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_skill');
    }
}
