<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('EDIT Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->
                <div class="container-fluid"  style="margin: 20px;">
                <div class="row" style="padding: 20;">
                    <div class="col-sm-6">
                    <form action="{{url('saveEditClient')}}" method="post">

                            @csrf
                            <input type="hidden" name="id" class="form-control" id="id" value="{{$editClients->id}}" >
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" value="{{$editClients->first_name}}" >
                              
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" value="{{$editClients->last_name}}" >
                              
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Name</label>
                                <input type="text" name="company_name" class="form-control" id="company_name" value="{{$editClients->company_name}}" >
                              
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="email" class="form-control" id="email" value="{{$editClients->email}}" >
                              
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{$editClients->phone}}" >
                              
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
