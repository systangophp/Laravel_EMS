<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Skil;
use Illuminate\Support\Facades\Validator;

class Skill extends Controller
{
    public function webGetSkills(){

        $data = Skil::all();
        if($data->count() > 0)
        return view('/skill',["Skills" => $data ]);
        else
        return view('/skill',["Skills" => '' ]);
    }
    public function webGetSkill($offset, $limit){

        $data = Skil::all();
        $data = $data->skip($offset)->take($limit);
        //return $data;
        if($data->count() > 0)
        return view('/skill',["Skills" => $data ]);
        else
        return view('/skill',["Skills" => '' ]);
    }

    public function webEditSkills($id){
        
        $data = Skil::find($id);
        //return $data;
        if($data->count() > 0)
        return view('/editSkill',["editSkills" =>$data ]);
        
    }

    public function showAddForm(){

        
        return view('/skill',["Skills" => '' ]);
    }
    public function webAddSkills(Request $request){
        $data = New Skil();
        $data->skill_name= $request->name;
        $data->short_code= $request->short_name;
        $data->language= $request->language;

        $response = $data->save();

        if($response){
            $request->session()->flash('message', 'Record was successfully Added!');
            return redirect('/skill');
        }
    }
    public function webSaveEditSkills(Request $request){

        $id = $request->id;
        $data = Skil::find($id);
        $data->skill_name= $request->name;
        $data->short_code= $request->short_name;
        $data->language= $request->language;

        $response = $data->save();

        if($response){
            $request->session()->flash('message', 'Records was successfully Edited !');
            return redirect('/skill');
        }
        
    }

    public function webDeleteSkills($id){

        
        $data = Skil::find($id);
        $response = $data->delete();       

        if($response){
            return redirect('/skill')->with('message', 'Record was successfully Deleted!');;
        }
        
    }

    /* API */
    public function apiGetSkillsById($id){
        $data = Skil::find($id);
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
    public function apiGetSkills(){
        $data = Skil::all();
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

    public function apiGetSkill($offset,$limit){
        $data = New Skil();
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
    public function apiAddSkills(Request $request){
        $data = New Skil();

        //Init Rules
        $rules=array(
            'name' => 'required',
            'short_name' => 'required',
            'language' => 'required'
        );
        //Message
        $messages=array(
            'name.required' => 'Please enter a name.',
            'short_name.required' => 'Please enter a short_name.',
            'language.required' => 'Please enter a language.'
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

        $data->skill_name= $request->name;
        $data->short_code= $request->short_name;
        $data->language= $request->language;

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

    public function apiEditSkills(Request $request, $id){
        $data = Skil::find($id);

        if(!$data){
            return response()->json([
                'status'   => 'error',
                'message'  => "Record is deleted"
             ],200);
        }

        //Init Rules
        $rules=array(
            'name' => 'required',
            'short_name' => 'required',
            'language' => 'required'
        );
        //Message
        $messages=array(
            'name.required' => 'Please enter a name.',
            'short_name.required' => 'Please enter a short_name.',
            'language.required' => 'Please enter a language.'
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
        
        $data->skill_name= $request->name;
        $data->short_code= $request->short_name;
        $data->language= $request->language;

        $response = $data->save();

        if($response){
            
            $res = Skil::find($id);  
            return response()->json([
                'status'   => 'success',
                'message'  => 'Records Updated Successfully with Id',
                'id' => $data->id,
                'data' => $res
             ],200);
        }
        
    }
    public function apiDeleteSkills($id){

        
        $data = Skil::find($id);
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

    //Relationship
    public function apiShowEmployeesForSkills($id){

        //dd($id);

        $skills = Skil::find($id);
        
        $empDataWithSkill['Skills'] = $skills;
        $skillId = [];
        $skillLevel = [];
        if($skills->count() > 0){
            $empskills = $skills->Employees;
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



}
