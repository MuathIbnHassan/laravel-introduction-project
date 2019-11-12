
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Create New Employee Record</div>

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
            <form action="{{ route('employee.update',$employee->id) }}" method="POST" role="form" enctype="multipart/form-data">
               @method('PUT')
               @csrf


               <div class="form-group row">
                  <label for="id" class="col-md-4 col-form-label text-md-right">ID</label>
                  <div class="col-md-6">
                        <input id="id" type="text" class="form-control" name="id" value="{{ $employee->id }}" disabled>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                  <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $employee->first_name }}">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                  <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $employee->last_name }}">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                  <div class="col-md-6">
                        <input id="email" type="text" class="form-control" name="email" value="{{ $employee->email }}">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                  <div class="col-md-6">
                        <input id="phone" type="text" class="form-control" name="phone"  value="{{ $employee->phone }}">
                  </div>
               </div>
                <div class="form-group row">
                  <label for="company_id" class="col-md-4 col-form-label text-md-right">Company ID</label>
                  <div class="col-md-6">
                        <input id="company_id" type="text" class="form-control" name="company_id"  value="{{ $employee->company_id }}">
                  </div>
               </div>
               
               
               <div class="form-group row mb-0 mt-5">
                  <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                  </div>
               </div>
            </form>  
               </div>
            </div>
         </div>
      </div>
</div>
@endsection