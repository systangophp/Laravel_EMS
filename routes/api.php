<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Skill;
use App\Http\Controllers\Employees;
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
    Route::get('/skills/{id}',[Skill::class,'apiGetSkillsById']);
    Route::post('/skill',[Skill::class,'apiAddSkills']);
    Route::put('/skill/{id}',[Skill::class,'apiEditSkills']);
    Route::delete('/skill/{id}',[Skill::class,'apiDeleteSkills']);

    /* Employee API */
    Route::get('/employees',[Employees::class,'apiGetEmployees']);
    Route::get('/employees/{id}',[Employees::class,'apiGetEmployeesById']);
    Route::post('/employees',[Employees::class,'apiAddEmployee']);
    Route::put('/employees/{id}',[Employees::class,'apiEditEmployee']);
    Route::delete('/employees/{id}',[Employees::class,'apiDeleteEmployee']);
});
