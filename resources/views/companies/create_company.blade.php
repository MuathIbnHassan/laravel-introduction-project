@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <div class="card-header">Create New Company Record</div>

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

                    <form action="{{ route('company.create') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                           <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                           <div class="col-md-6">
                                 <input id="name" type="text" class="form-control" name="name"  value="{{ old("name") }}">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                           <div class="col-md-6">
                                 <input id="email" type="text" class="form-control" name="email" value="{{ old("email") }}">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="website" class="col-md-4 col-form-label text-md-right">Website</label>
                           <div class="col-md-6">
                                 <input id="website" type="text" class="form-control" name="website" value="{{ old("website") }}">
                           </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">Company Image</label>
                                <div class="col-md-6">
                                <input id="logo" type="file" class="form-control" name="logo">
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
