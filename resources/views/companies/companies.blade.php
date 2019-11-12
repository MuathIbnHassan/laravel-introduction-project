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
         <div class="card-columns">
                
               
         @foreach($companies as $company)
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
            </div>
         <ul class="pagination justify-content-center" style="margin: 40px 0">
            {!! $companies->links() !!}
         </ul>
      </div>
   </div>
</div>
@endsection
