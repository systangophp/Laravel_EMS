<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Skills') }}
        </h2>
       
    </x-slot>
   
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->

                
                <div class="container-fluid"  style="margin: 20px;">
                <div class="row" style="padding: 20;">
                    <div class="col-sm-6">

                   
                    @if($Skills=='')
                    
                        <form action="{{url('addSkill')}}" method="post">
                            @csrf
                            <div class="form-group">

                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" id="name" >
                               
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Short Name</label>
                                <input type="text" name="short_name" class="form-control" id="short_name">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Language</label>
                                <input type="text" name="language" class="form-control" id="language">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                @else
                    </div>
                </div>
               
                <a href="skill\add"><button style="float: right;margin-bottom: 10px;margin-right: 25px;background: #343a40;" type="button" class="btn btn-secondary btn-lg">Add Skill</button></a>
                @if(Session::has('message'))

                <div class="alert alert-success" role="alert" style="max-width: 76%">
                {{Session::get('message') }}
                </div>
                @endif
                
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Skill Name</th>
                        <th scope="col">Short Name</th>
                        <th scope="col">Language</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1
                        @endphp
                        @foreach($Skills as $skill)
                        <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$skill->skill_name}}</td>
                        <td>{{$skill->short_code}}</td>
                        <td>{{$skill->language}}</td>
                        <td><a href="{{url('editSkill/'.$skill->id)}}"> <i class="bi bi-pencil-square"></i></a> <a href="{{url('deleteSkill/'.$skill->id)}}"> <i class="bi bi-x-octagon-fill"></i></a></td>
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
