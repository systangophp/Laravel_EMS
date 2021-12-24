<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('EDIT Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->
                <div class="container-fluid"  style="margin: 20px;">
                <div class="row" style="padding: 20;">
                    <div class="col-sm-6">
                    <form action="{{url('saveEditEmployee')}}" method="post">

                            @csrf
                            <input type="hidden" name="id" class="form-control" id="id" value="{{$editEmployees->id}}" >
                            <div class="form-group">

                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" value="{{$editEmployees->first_name}}" >
                               
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" value="{{$editEmployees->last_name}}" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{$editEmployees->email}}" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{$editEmployees->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Designation</label>
                                <input type="text" name="designation" class="form-control" id="designation" value="{{$editEmployees->designation}}">
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
