<?php

namespace App\Models;
//namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The skill that belong to the emp.
     */
    public function skills()
    {
        
        return $this->belongsToMany(Skil::class, 'employee_skill')->as('skillLevel')->withPivot('level');
    }
}
