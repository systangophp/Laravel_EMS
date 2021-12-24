<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skil;
use App\Models\Employee;

class test extends Controller
{
    public function getSkillsByEmp($id){
      $user = Employee::find(1);
      return $user->skills;	
        
    }
    public function getEmpBySkill($id){
        $user = skil::find($id);
        return $user->Employees;	
          
      }
}
