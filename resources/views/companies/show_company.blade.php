
<!DOCTYPE html>
 
<html lang="en">
<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 
</head>

   @extends('layouts.app')
   @section('content')
   

   
   <div class="container-fluid">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card">
               <div class="card-header">Show Company Information</div>
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
               <div class="card-deck bg-light text-dark">
                  <div class="card-body">
                     <h4 class="card-title">{{ $company->id }}: {{ $company->name }}</h4>
                     <p class="card-text">{{ $company->email }}</p>
                     <p class="card-text">{{ $company->website }}</p>
                     <form action="{{ route('company.update',$company->id) }}" method="POST" role="form" enctype="multipart/form-data">
                        @method('DELETE')
                        @csrf
                        <a href="/employees/create?company_id={{ $company->id }}" class="btn btn-success ">Add New Employee</a>
                        <a href="/companies/{{ $company->id }}/edit" class="btn btn-warning ">Edit Info</a>
                        <input type="submit" class="btn btn-danger" value="DELETE">
                     </form>
                  </div>
                  <img class="card-img-top" src="/storage/{{ $company->logo }}"   alt="Card image" style="width:40%">
               </div>
               <div class="card-footer card-columns">
                  
                     
                     
                        @foreach($company->employees as $employee)
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
            </div>
         </div>
    </div>
   </div>
   @endsection

</html>