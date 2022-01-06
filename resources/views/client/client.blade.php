<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
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
                    
                        <form action="{{url('/client/addClient')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" >
                               
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Name</label>
                                <input type="text" name="company_name" class="form-control" id="company_name" >
                               
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" id="email" >
                               
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" >
                               
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                @else
                    </div>
                </div>
               
                <a href="{{url('client\add')}}"><button style="float: right;margin-bottom: 10px;margin-right: 25px;background: #343a40;" type="button" class="btn btn-secondary btn-lg">Add New</button></a>
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
