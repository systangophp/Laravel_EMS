<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
       
    </x-slot>
   
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->

                
                <div class="container-fluid"  style="margin: 20px;">
                <div class="row" style="padding: 20;">
                    <div class="col-sm-6">
                  
                    @if($clients=='')
                    
                        <form action="{{url('/project/addProject')}}" method="post">
                            @csrf
                            <div class="form-group">

                                <label for="exampleInputEmail1">Project Name</label>
                                <input type="text" name="project_name" class="form-control" id="project_name" >
                               
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Technology</label>
                                <select name="technology" class="form-control" id="exampleFormControlSelect1">
                                    <option value="Wordpress">Wordpress</option>
                                    <option value="Zoho">Zoho</option>
                                    <option value="Laravel">Laravel</option>
                                    <option value="Creator">Creator</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <!-- <div class="form-group">
                                <label for="exampleInputPassword1">Technology</label>
                                <input type="text" name="technology" class="form-control" id="technology">
                            </div> -->

                            <div class="form-group">
                                <label for="exampleInputPassword1">Estimate Hours</label>
                                <input type="text" name="estimate_hours" class="form-control" id="estimate_hours">
                            </div>
                            <!-- <div class="form-group">
                                <label for="exampleInputPassword1">Status</label>
                                <input type="text" name="status" class="form-control" id="status">
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="exampleInputPassword1">Logged Hours</label>
                                <input type="text" name="logged_hours" class="form-control" id="logged_hours">
                            </div> -->
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                @else
                    </div>
                </div>
               
                <a href="{{url('project\add')}}"><button style="float: right;margin-bottom: 10px;margin-right: 25px;background: #343a40;" type="button" class="btn btn-secondary btn-lg">Add New</button></a>
                @if(Session::has('message'))

                <div class="alert alert-success" role="alert" style="max-width: 76%">
                {{Session::get('message') }}
                </div>
                @endif
                
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Client Code</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>                       
                        <th scope="col">Company Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        
                        <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1
                        @endphp
                        @foreach($clients as $client)
                        <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$client->client_code}}</td>
                        <td>{{$client->first_name}}</td>
                        <td>{{$client->last_name}}</td>
                        <td>{{$client->company_name}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->phone}}</td>
                        <td> <a href="{{url('/editclient/'.$client->id)}}"> <i class="bi bi-pencil-square"></i></a> <a href="{{url('deleteclient/'.$client->id)}}"> <i class="bi bi-x-octagon-fill"></i></a></td>
                        </tr>
                        @php
                            $i = $i+1
                        @endphp
                       @endforeach
                    </tbody>
                    </table>
                    @endif

                    

               
                </div>
            </div>
        </div>
    </div>
       
</x-app-layout>
