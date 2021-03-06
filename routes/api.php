<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Skill;
use App\Http\Controllers\Employees;
use App\Http\Controllers\Projects;
use App\Http\Controllers\Clients;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'],function (){


    /* Skill API */
    Route::get('/skills',[Skill::class,'apiGetSkills']);

    Route::get('/skills/{offset}/{limit}',[Skill::class,'apiGetSkill']);
   

    Route::get('/skills/{id}',[Skill::class,'apiGetSkillsById']);
    Route::post('/skill',[Skill::class,'apiAddSkills']);
    Route::put('/skill/{id}',[Skill::class,'apiEditSkills']);
    Route::delete('/skill/{id}',[Skill::class,'apiDeleteSkills']);

    // /* Employee API */
    Route::get('/employees',[Employees::class,'apiGetEmployees']);
    Route::get('/employees/{offset}/{limit}',[Employees::class,'apiGetEmployee']);
    Route::get('/employees/{id}',[Employees::class,'apiGetEmployeesById']);
    Route::post('/employees',[Employees::class,'apiAddEmployee']);
    Route::put('/employees/{id}',[Employees::class,'apiEditEmployee']);
    Route::delete('/employees/{id}',[Employees::class,'apiDeleteEmployee']);

    // /* Project API */
     
    Route::get('/projects',[Projects::class,'apiGetProjects']);
    Route::get('/projects/{offset}/{limit}',[Projects::class,'apiGetProjects']);
    Route::get('/projects/{id}',[Projects::class,'apiGetProjectsById']);
    Route::post('/projects',[Projects::class,'apiAddProject']);
    Route::put('/projects/{id}',[Projects::class,'apiEditProject']);
    Route::delete('/projects/{id}',[Projects::class,'apiDeleteProjects']);

    // /* Client API */
     
    Route::get('/clients',[Clients::class,'apiGetClients']);
    Route::get('/clients/{offset}/{limit}',[Clients::class,'apiGetClients']);
    Route::get('/clients/{id}',[Clients::class,'apiGetClientsById']);
    Route::post('/clients',[Clients::class,'apiAddClient']);
    Route::put('/clients/{id}',[Clients::class,'apiEditClient']);
    Route::delete('/clients/{id}',[Clients::class,'apiDeleteClients']);

    // /* RelationShip */
    Route::get('/employee/{id}/skills',[Employees::class,'apiShowSkillsForEmployee']);
    Route::get('/skill/{id}/employee',[Skill::class,'apiShowEmployeesForSkills']);
    Route::post('/employee_skill/{id}',[Employees::class,'apiAssignSkillToEmployee']);
    


    
});
