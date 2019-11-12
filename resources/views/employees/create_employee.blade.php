@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <div class="card-header">Create New employee Record</div>

               <div class="card-body">
                    
                  @if (session('status'))
                  <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                  </div>
                  @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('employee.create') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                           <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                           <div class="col-md-6">
                                 <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old("first_name") }}">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                           <div class="col-md-6">
                                 <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old("last_name") }}">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                           <div class="col-md-6">
                                 <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                           <div class="col-md-6">
                                 <input id="phone" type="text" class="form-control" name="phone" value="{{ old("phone") }}">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="company_id" class="col-md-4 col-form-label text-md-right">Company</label>
                           <div class="col-md-6">
                                 <select class="form-control" id="company_id" name="company_id" value="100">
                                    @foreach ($companies as $company)   
                                          <option value="{{ $company->id }}" {{ ($company_id == $company->id ? "selected":"") }}>{{ $company->name }}</option>                                      
                                          <option value="{{ $company->id }}">{!! $company->name !!}</option>
                                    @endforeach
                              </select>   
                           </div>
                        </div>
                                             

                        <div class="form-group row mb-0 mt-5">
                           <div class="col-md-8 offset-md-4">
                                 <button type="submit" class="btn btn-primary">Create Profile</button>
                           </div>
                        </div>
                    </form>  

                    
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
