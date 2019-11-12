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
               {{ session('error') }}
      </div>
   @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-columns">
                
               
            @foreach($employees as $employee)
            <div class="card bg-light text-dark">
              

               <div class="card-body">

                  <h4 class="card-title">{{ $employee->id }}: {{ $employee->first_name }} {{ $employee->last_name }}</h4>
                  <p class="card-text">{{ $employee->email }}</p>
                  <p class="card-text">{{ $employee->phone }}</p>

                  <a href="/employees/{{ $employee->id }}" class="btn btn-primary stretched-link">See Profile</a>
                  
               </div>
              
            </div>  
            @endforeach
         </div>
         <ul class="pagination justify-content-center" style="margin: 40px 0">
            {!! $employees->links() !!}
         </ul>
      </div>
   </div>
</div>
@endsection
