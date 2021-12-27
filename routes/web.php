<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Skill;
use App\Http\Controllers\Employees;
use App\Http\Controllers\Projects;
use App\Http\Controllers\test;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test',[test::class,'show']);

/*Skill Route*/
Route::get('/skill',[Skill::class,'webGetSkills']);
Route::get('/skill/add',[Skill::class,'showAddForm']);
Route::post('addSkill',[Skill::class,'webAddSkills']);
Route::get('editSkill/{id}',[Skill::class,'webEditSkills']);
Route::get('deleteSkill/{id}',[Skill::class,'webDeleteSkills']);
Route::post('saveEditSkill',[Skill::class,'webSaveEditSkills']);

/*Employee Route*/

Route::get('/employee',[Employees::class,'webGetEmployee']);
Route::get('/employee/add',[Employees::class,'showAddForm']);
Route::post('/employee/addEmp',[Employees::class,'webAddEmployees']);

Route::get('editEmployee/{id}',[Employees::class,'webEditEmployees']);
Route::get('deleteEmployee/{id}',[Employees::class,'webDeleteSkills']);
Route::post('saveEditEmployee',[Employees::class,'webSaveEditEmployees']);

/* Skill -> Employee */
Route::get('/addSkillForEmployee/{id}',[Employees::class,'showSkillsForEmployee']);
Route::post('/assignSkillToEmp',[Employees::class,'assignSkillToEmp']);
//Route::get('/addSkillForEmployee/{id}',[Employees::class,'showSkillsForEmployee']);

/* Projects */
Route::get('/project',[Projects::class,'webGetProjects']);
Route::get('/project/add',[Projects::class,'showAddForm']);
Route::post('/project/addProject',[Projects::class,'webAddProjects']);

Route::get('editproject/{id}',[Projects::class,'webEditProjects']);
Route::get('deleteproject/{id}',[Projects::class,'webDeleteProjects']);
Route::post('saveEditProject',[Projects::class,'webSaveEditProjects']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
