@extends('layouts.app')

@section('content')
<div class="container-fluid">
   @if (session('status'))
      <div class="alert alert-success" role="alert">
            {{ session('status') }}
      </div>
   @endif
   @if (session('error'))
      <div class="alert alert-danger" role="alert">
            {{ session('status') }}
      </div>
   @endif
   <div class="row justify-content-center">
      <div class="col-md-8">

         <div class="card-body">
            <h4 class="card-title">Tag : {{ $tag->tag_name }}</h4>
            <h4 class="card-title">ID : {{ $tag->id }}</h4>
            <form action="{{ route('tag.delete',$tag->id) }}" method="POST" role="form" enctype="multipart/form-data">
               @method('DELETE')
               @csrf
               <input type="submit" class="btn btn-danger" value="DELETE">
            </form>
               
         </div>



         <div class="card-header">Companies</div>      
         <div class="card-columns">
         @if (count($tag->companies) === 0)
            There is no Compamies!
         @else
         @foreach($tag->companies as $company)
         <div class="card bg-light text-dark">
            

               <div class="card-body" >
                  <img class="card-img-top" src="/storage/{{ $company->logo }}"   alt="Company Logo">
                  <h4 class="card-title">{{ $company->id }}: {{ $company->name }}</h4>
                  <p class="card-text">{{ $company->email }}</p>
                  <p class="card-text">{{ $company->website }}</p>
                  <a href="/companies/{{ $company->id }}" class="btn btn-primary stretched-link">See Profile</a>
               </div>
               
            </div>  
            @endforeach
            @endif
            </div>
         <div class="card-header">Employees</div>      

            <div class="card-columns">
               @if (count($tag->employees) === 0)
            There is no Employees!
         @else
         @foreach($tag->employees as $employee)
            <div class="card bg-light text-dark">
              

               <div class="card-body">

                  <h4 class="card-title">{{ $employee->id }}: {{ $employee->first_name }} {{ $employee->last_name }}</h4>
                  <p class="card-text">{{ $employee->email }}</p>
                  <p class="card-text">{{ $employee->phone }}</p>

                  <a href="/employees/{{ $employee->id }}" class="btn btn-primary stretched-link">See Profile</a>
                  
               </div>
              
            </div>  
            @endforeach
            @endif

            </div>
      </div>
   </div>
</div>
@endsection
