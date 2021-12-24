<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('EDIT SKILL') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->
                <div class="container-fluid"  style="margin: 20px;">
                <div class="row" style="padding: 20;">
                    <div class="col-sm-6">
                    <form action="{{url('saveEditSkill')}}" method="post">

                            @csrf
                            <input type="hidden" name="id" class="form-control" id="id" value="{{$editSkills->id}}" >
                            <div class="form-group">

                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{$editSkills->skill_name}}" >
                               
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Short Name</label>
                                <input type="text" name="short_name" class="form-control" id="short_name" value="{{$editSkills->short_code}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Language</label>
                                <input type="text" name="language" class="form-control" id="language" value="{{$editSkills->language}}">
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
