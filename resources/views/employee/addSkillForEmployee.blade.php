<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Skill') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->
                <div class="container-fluid"  style="margin: 20px;">
                <div class="row" style="padding: 20;">
                    <div class="col-sm-12">
                    <form action="{{url('assignSkillToEmp')}}" method="post">

                            @csrf
                           
                            @php 
                              $empskills = json_decode($empskills);
                            @endphp
                            <input type="hidden" name="id" class="form-control" id="id" value="{{$id}}" >
                            <div class="form-group">
                                <label for="exampleInputEmail1">Skill</label>
                                <!-- <select class="custom-select"  multiple data-live-search="true" name ="Skill[]">
                                    @foreach($skills as $skill)
                                          <option value="{{$skill->id}}" {{(in_array($skill->id,$empskills)) ? 'selected' : '' }}>{{$skill->skill_name}}</option>
                                          
                                   
                                    @endforeach
                                </select> -->
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Skill Name</th>
                        <!-- <th scope="col">Don't Know?</th> -->
                        <th scope="col">Beginner</th>
                        <th scope="col">Intermediate</th>
                        <th scope="col">Expert</th>
                        <th scope="col">Supper Expert</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1
                        @endphp
                        @foreach($skills as $skill)
                        <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$skill->skill_name}}</td>
                        <td><div class="form-check">
                                <input class="form-check-input" type="radio" name="{{$skill->id}}" value="1" id="flexRadioDefault1">
                            </div>
                        </td>
                        <td><div class="form-check">
                                <input class="form-check-input" type="radio" name="{{$skill->id}}" value="2" id="flexRadioDefault1">
                            </div>
                        </td>
                        <td><div class="form-check">
                                <input class="form-check-input" type="radio" name="{{$skill->id}}" value="2" id="flexRadioDefault1">
                            </div>
                        </td>
                        <td><div class="form-check">
                                <input class="form-check-input" type="radio" name="{{$skill->id}}" value="2" id="flexRadioDefault1">
                            </div>
                        </td>
                        <!-- <td><div class="form-check">
                                <input class="form-check-input" type="radio" name="{{$skill->skill_name}}" id="flexRadioDefault1">
                            </div>
                        </td>
                         -->
                        
                        </tr>
                        @php
                            $i = $i+1
                        @endphp
                       @endforeach
                    </tbody>
                    </table>
                    
                       
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
