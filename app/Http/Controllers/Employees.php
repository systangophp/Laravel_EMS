<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Skil;
use App\Models\EmployeeSkill;
use Illuminate\Support\Facades\Validator;

class Employees extends Controller
{

    public function showSkillsForEmployee($id){

        $skills = Employee::find($id);
        $skillId = [];
        $skillLevel = [];
        if($skills->count() > 0){
            $empskills = $skills->skills;
            foreach($empskills as $empskill){
                
                $skillId []=$empskill->id;
                $skillLevel [$empskill->id] =$empskill->skillLevel->level;
            }
            //return $skillLevel;
        }else
        $skillId = [];
         
        $data = Skil::all();
        //return $data;
        if($data->count() > 0)
        return view('/employee/addSkillForEmployee',["skills" => $data, "id" => $id,"empskills" => json_encode($skillId), "empskillslevel" => json_encode($skillLevel)]);
        else
        return view('/employee/addSkillForEmployee',["skills" => '', "id" => '',"empskills" => '', "empskillslevel" => json_encode($skillLevel) ]);
    }

    public function assignSkillToEmpOld(Request $request){

        return $request;
       
        $emp_id = $request->id;
        $skill = $request->Skill;
        print_r($skill);
        $data = EmployeeSkill::where('employee_id', $emp_id)
        ->get();
        if($data->count() > 0){
            $data = EmployeeSkill::destroy($data->pluck('id')->toArray());
           
        }

        foreach($skill as $sk){
            $addSkill = New EmployeeSkill();
            $addSkill->employee_id = $emp_id;
            $addSkill->skil_id = $sk;
            $addSkill->save();
        }
        //return $addSkill;
        $request->session()->flash('message', 'Record was successfully Added!');
        return redirect('/employee');
    }

    public function assignSkillToEmp(Request $request){

        $emp_id = $request->employee_id;
       // $data = $request->all();
        $records_data = $request->except('_token','employee_id');
        
        $data = EmployeeSkill::where('employee_id', $emp_id)->get();
        if($data->count() > 0){
            $data = EmployeeSkill::destroy($data->pluck('id')->toArray());
        }

        foreach($records_data as $skill_id=>$level){
            echo $skill_id."\n";
            $addSkill = New EmployeeSkill();
            $addSkill->employee_id = $emp_id;
            $addSkill->skil_id = $skill_id;
            $addSkill->level = $level;
            $addSkill->save();
        }
        $request->session()->flash('message', 'Record was successfully Added!');
        return redirect('/employee');
    }
    
    public function webGetEmployee(){

        $data = Employee::all();
        if($data->count() > 0)
        return view('/employee/employee',["employees" => $data ]);
        else
        return view('/employee/employee',["employees" => '' ]);
    }

    public function webEditEmployees($id){
        
        $data = Employee::find($id);
        //return $data;
        if($data->count() > 0)
        return view('/employee/editEmployee',["editEmployees" =>$data ]);
        
    }
    public function showAddForm(){

        
        return view('/employee/employee',["employees" => '' ]);
    }
    public function webAddEmployees(Request $request){
        $data = New Employee();
        $randomNumber = random_int(100000, 999999);
        $data->emp_id= $randomNumber;
        $data->first_name= $request->first_name;
        $data->last_name= $request->last_name;
        $data->email= $request->email;
        $data->phone= $request->phone;
        $data->designation= $request->designation;
        $response = $data->save();

        if($response){
            $request->session()->flash('message', 'Record was successfully Added!');
            return redirect('/employee');
        }
    }

    public function webSaveEditEmployees(Request $request){

        $id = $request->id;
        $data = Employee::find($id);
        $data->first_name= $request->first_name;
        $data->last_name= $request->last_name;
        $data->email= $request->email;
        $data->phone= $request->phone;
        $data->designation= $request->designation;

        $response = $data->save();

        if($response){
            $request->session()->flash('message', 'Records was successfully Edited !');
            return redirect('/employee');
        }
        
    }

    /* API */

    public function apiShowSkillsForEmployee($id){

        $skills = Employee::find($id);
        
        $empDataWithSkill['Employee'] = $skills;
        $skillId = [];
        $skillLevel = [];
        if($skills->count() > 0){
            $empskills = $skills->skills;
            $skillCount = $empskills->count();
            return response()->json([
                'status'   => 'Success',
                'totalRecords' => $skillCount, 
                'data' => $empDataWithSkill
             ],200);
            
        }else{
            $skillId = [];
            return response()->json([
                'status'   => 'error', 
                'Message'  => 'Empty Records',
                'data' => []
             ],200);
        }
    }

    public function apiAssignSkillToEmployee(Request $request,$id){

        $emp_id = $id;
        
        $records_data = $request->all();
       
       // $records_data = $request->except('_token','employee_id');
        
        $data = EmployeeSkill::where('employee_id', $emp_id)->get();
        if($data->count() > 0){
            $data = EmployeeSkill::destroy($data->pluck('id')->toArray());
        }

        foreach($records_data as $skill_id=>$level){
    
            $addSkill = New EmployeeSkill();
            $addSkill->employee_id = $emp_id;
            $addSkill->skil_id = $skill_id;
            $addSkill->level = $level;
            $addSkill->save();
        }
       return $this->apiShowSkillsForEmployee($id);
    }

    public function apiGetEmployees(){
        $data = Employee::all();
        $count = $data->count();
        if($data){
            return response()->json([
                'status'   => 'success',
                'totalRecords' => $count, 
                'data' => $data
             ],200);
        }else{
            return response()->json([
                'status'   => 'error',
                'data' => $data
             ],200);
        }
    }
    public function apiGetEmployee($offset,$limit){
        $data = New Employee();
        $count = $data->all()->count();
        $data = $data->skip($offset)->take($limit)->get();
        
        if($data){
            return response()->json([
                'status'   => 'success',
                'totalRecords' => $count, 
                'data' => $data
             ],200);
        }else{
            return response()->json([
                'status'   => 'error',
                'data' => $data
             ],200);
        }
    }
    public function apiGetEmployeesById($id){
        $data = Employee::find($id);
        if($data){
            return response()->json([
                'status'   => 'success',
                'data' => $data
             ],200);
        }else{
            return response()->json([
                'status'   => 'error',
                'data' => $data
             ],200);
        }
    }


    public function apiAddEmployee(Request $request){
        $data = New Employee();

        //Init Rules
        $rules=array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'digits:10'
        );
        //Message
        $messages=array(
            'first_name.required' => 'Please enter a first_name.',
            'last_name.required' => 'Please enter a last_name.',
            'email.required' => 'Please enter a email.',            
            'phone.digits' => 'Please enter a digits.'
        );

        $validator=Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            // $messages=$validator->messages();
            // $errors=$messages->all();
            // return $errors;
            return response()->json([
                'status'   => 'error',
                'message'  => $validator->getMessageBag()
             ],400);
        }

        $randomNumber = random_int(100000, 999999);
        $data->emp_id= $randomNumber;
        $data->first_name= $request->first_name;
        $data->last_name= $request->last_name;
        $data->email= $request->email;
        $data->phone= $request->phone;
        $data->designation= $request->designation;
        $response = $data->save();        

        if($response){
            
            $res = $data->latest('id')->first();            
            return response()->json([
                'status'   => 'success',
                'message'  => 'Records Created Successfully with Id',
                'id' => $data->id,
                'data' => $res
             ],200);
        }
    }

    public function apiEditEmployee(Request $request, $id){
        $data = Employee::find($id);

        if(!$data){
            return response()->json([
                'status'   => 'error',
                'message'  => "Record is deleted"
             ],200);
        }

        //Init Rules
        $rules=array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'digits:10'
        );
        //Message
        $messages=array(
            'first_name.required' => 'Please enter a first_name.',
            'last_name.required' => 'Please enter a last_name.',
            'email.required' => 'Please enter a email.',            
            'phone.digits' => 'Please enter a digits.'
        );

        $validator=Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            // $messages=$validator->messages();
            // $errors=$messages->all();
            // return $errors;
            return response()->json([
                'status'   => 'error',
                'message'  => $validator->getMessageBag()
             ],400);
        }
        
        $data->first_name= $request->first_name;
        $data->last_name= $request->last_name;
        $data->email= $request->email;
        $data->phone= $request->phone;
        $data->designation= $request->designation;
        $response = $data->save();

        $response = $data->save();

        if($response){
            
            $res =Employee::find($id);  
            return response()->json([
                'status'   => 'success',
                'message'  => 'Records Updated Successfully with Id',
                'id' => $data->id,
                'data' => $res
             ],200);
        }
        
    }

    public function apiDeleteEmployee($id){

        
        $data = Employee::find($id);
        if(!$data){
            return response()->json([
                'status'   => 'error',
                'message'  => "Record Already Deleted!"
             ],200);
        }
        $response = $data->delete();       

        if($response){
            return response()->json([
                'status'   => 'success',
                'message'  => 'Records Deleted Successfully with Id',
                'id' => $data->id,
                'data' => $response
             ],200);
        }else{
            return response()->json([
                'status'   => 'error',
                'message'  => $response
             ],400);
        }
        
    }
}
