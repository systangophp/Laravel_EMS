<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('EDIT Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->
                <div class="container-fluid"  style="margin: 20px;">
                <div class="row" style="padding: 20;">
                    <div class="col-sm-6">
                    <form action="{{url('saveEditProject')}}" method="post">

                            @csrf
                            <input type="hidden" name="id" class="form-control" id="id" value="{{$editProjects->id}}" >
                            <div class="form-group">

                                <label for="exampleInputEmail1">Project Name</label>
                                <input type="text" name="project_name" class="form-control" id="project_name" value="{{$editProjects->project_name}}" >
                               
                            </div>
                            @php 
                            $selected ='';
                            @endphp
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Technology</label>
                                <select name="technology" class="form-control" id="exampleFormControlSelect1">
                                    <option value="-1">None</option>
                                    <option value="Wordpress" {{ $editProjects->technology =='Wordpress' ? "selected" : "" }}>Wordpress</option>
                                    <option value="Zoho"  {{ $editProjects->technology =='Zoho' ? "selected" : "" }}>Zoho</option>
                                    <option value="Laravel"  {{ $editProjects->technology =='Laravel' ? "selected" : "" }}>Laravel</option>
                                    <option value="Creator" {{ $editProjects->technology =='Creator' ? "selected" : "" }}>Creator</option>
                                    <option value="Other" {{ $editProjects->technology =='Other' ? "selected" : "" }}>Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Estimate Hours</label>
                                <input type="text" name="estimate_hours" class="form-control" id="estimate_hours" value="{{$editProjects->estimate_hours}}">
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
