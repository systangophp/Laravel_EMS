<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class Projects extends Controller
{
   
    public function webGetProjects(){

        $data = Project::all();
        if($data->count() > 0)
        return view('/project/project',["projects" => $data ]);
        else
        return view('/project/project',["projects" => '' ]);
    }

    public function webEditProjects($id){
        
        $data = Project::find($id);
        //return $data;
        if($data->count() > 0)
        return view('/project/editProject',["editProjects" =>$data ]);
        
    }
    public function showAddForm(){

        
        return view('/project/project',["projects" => '' ]);
    }
    public function webAddProjects(Request $request){
        $data = New Project();
        $randomNumber = random_int(100000, 999999);
        $data->project_code= $randomNumber;
        $data->project_name= $request->project_name;
        $data->technology= $request->technology;
        $data->estimate_hours= $request->estimate_hours;
        $data->status= "Created";
        $data->logged_hours= "0";
        $response = $data->save();

        if($response){
            $request->session()->flash('message', 'Record was successfully Added!');
            return redirect('/project');
        }
    }

    public function webSaveEditProjects(Request $request){

        $id = $request->id;
        $data = Project::find($id);
        $data->project_name= $request->project_name;
        $data->technology= $request->technology;
        $data->estimate_hours= $request->estimate_hours;

        $response = $data->save();

        if($response){
            $request->session()->flash('message', 'Records was successfully Edited !');
            return redirect('/project');
        }
        
    }
    public function webDeleteProjects($id){

        
        $data = Project::find($id);
        $response = $data->delete();       

        if($response){
            return redirect('/project')->with('message', 'Record was successfully Deleted!');;
        }
        
    }

    /* API */
    public function apiGetProjects(){
        $data = Project::all();
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
    public function apiGetProject($offset,$limit){
        $data = New Project();
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
    public function apiGetProjectsById($id){
        $data = Project::find($id);
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


    public function apiAddProject(Request $request){
        $data = New Project();

        //Init Rules
        $rules=array(
            'project_name' => 'required',
            'technology' => 'required',
            'status' => 'required',
            'estimate_hours' => 'numeric',
        );
        //Message
        $messages=array(
            'project_name.required' => 'Please enter a project_name.',
            'technology.required' => 'Please enter a technology.',
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
        $data->project_code= $randomNumber;
        $data->project_name= $request->project_name;
        $data->technology= $request->technology;
        $data->estimate_hours= $request->estimate_hours;
        if($request->status ==""){
            $data->status ="Created"; 
        }else{
            $data->status =$request->status; 
        }
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

    public function apiEditProject(Request $request, $id){
        $data = Project::find($id);

        if(!$data){
            return response()->json([
                'status'   => 'error',
                'message'  => "Record is deleted"
             ],200);
        }

        //Init Rules
        $rules=array(
            'project_name' => 'required',
            'technology' => 'required',            
            'estimate_hours' => 'numeric',
        );
        //Message
        $messages=array(
            'project_name.required' => 'Please enter a project_name.',
            'technology.required' => 'Please enter a technology.',
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

        
       
        $data->project_name= $request->project_name;
        $data->technology= $request->technology;
        $data->estimate_hours= $request->estimate_hours;
        
        $response = $data->save();        


        if($response){
            
            $res =Project::find($id);  
            return response()->json([
                'status'   => 'success',
                'message'  => 'Records Updated Successfully with Id',
                'id' => $data->id,
                'data' => $res
             ],200);
        }
        
    }

    public function apiDeleteProjects($id){

        
        $data = Project::find($id);
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
