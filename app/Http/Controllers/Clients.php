<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class Clients extends Controller
{
    
    public function webGetClient(){

        $data = Client::all();
        if($data->count() > 0)
        return view('/client/client',["clients" => $data ]);
        else
        return view('/client/client',["clients" => '' ]);
    }

    public function webEditClients($id){
        
        $data = Client::find($id);
        //return $data;
        if($data->count() > 0)
        return view('/client/editClient',["editClients" =>$data ]);
        
    }
    public function showAddForm(){

        
        return view('/client/client',["clients" => '' ]);
    }

    public function webAddClients(Request $request){
        $data = New Client();
        $randomNumber = random_int(100000, 999999);
        $data->client_code= $randomNumber;
        $data->first_name= $request->first_name;
        $data->last_name= $request->last_name;
        $data->email= $request->email;
        $data->phone= $request->phone;
        $data->company_name= $request->company_name;
        $response = $data->save();

        if($response){
            $request->session()->flash('message', 'Record was successfully Added!');
            return redirect('/client');
        }
    }

    public function webSaveEditClients(Request $request){

        $id = $request->id;
        $data = Client::find($id);
        $data->first_name= $request->first_name;
        $data->last_name= $request->last_name;
        $data->email= $request->email;
        $data->phone= $request->phone;
        $data->company_name= $request->company_name;

        $response = $data->save();

        if($response){
            $request->session()->flash('message', 'Records was successfully Edited !');
            return redirect('/client');
        }
    }
    public function webDeleteClients($id){

        
        $data = Client::find($id);
        $response = $data->delete();       

        if($response){
            return redirect('/client')->with('message', 'Record was successfully Deleted!');;
        }
        
    }

    /* API */
    public function apiGetClients(){
        $data = Client::all();
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
    public function apiGetClient($offset,$limit){
        $data = New Client();
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
    public function apiGetClientsById($id){
        $data = Client::find($id);
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

    public function apiAddClient(Request $request){
        $data = New Client();
        //return $data->all();
        //Init Rules
        $rules=array(
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'required',
            'email' => 'required|email|unique:clients',
            'phone' => 'digits:10'
        );

        //Message
        $messages=array(
            'first_name.required' => 'Please enter a first_name.',
            'last_name.required' => 'Please enter a last_name.',
            'email.required' => 'Please enter a email.', 
            'company_name.required' => 'Please enter a company_name.',           
            'phone.digits' => 'Please enter valid number.'
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
        $data->client_code= $randomNumber;
        $data->first_name= $request->first_name;
        $data->last_name= $request->last_name;
        $data->email= $request->email;
        $data->phone= $request->phone;
        $data->company_name= $request->company_name;
        $response = $data->save();        
        print_r($response);
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

    public function apiEditClient(Request $request, $id){
        $data = Client::find($id);

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
            'company_name' => 'required',
            'email' => 'required|email',
            'phone' => 'digits:10'
        );
        //Message
        $messages=array(
            'first_name.required' => 'Please enter a first_name.',
            'last_name.required' => 'Please enter a last_name.',
            'email.required' => 'Please enter a email.', 
            'company_name.required' => 'Please enter a company_name.',           
            'phone.digits' => 'Please enter vaild number.'
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
        $data->company_name= $request->company_name;
        $response = $data->save();      

        if($response){
            
            $res =Client::find($id);  
            return response()->json([
                'status'   => 'success',
                'message'  => 'Records Updated Successfully with Id',
                'id' => $data->id,
                'data' => $res
             ],200);
        }
        
    }

    public function apiDeleteClients($id){

        
        $data = Client::find($id);
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
