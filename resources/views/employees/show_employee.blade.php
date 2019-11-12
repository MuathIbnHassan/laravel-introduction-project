
<!DOCTYPE html>
 
<html lang="en">
<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 
</head>

   @extends('layouts.app')
   @section('content')

   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card">
               
               <div class="card-header">Show Employee Information</div>
               <div class="card bg-light text-dark">
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
              
                  <div class="card-body">
                     <h4 class="card-title">ID: {{ $employee->id }}</h4>
                     <p class="card-text">First Name : {{ $employee->first_name }}</p>
                     <p class="card-text">Last Name : {{ $employee->last_name }}</p>
                     <p class="card-text">Company Name : {{ $employee->company->name }}</p>
                     <p class="card-text">E-mail : {{ $employee->email }}</p>
                     <p class="card-text">Phone : {{ $employee->phone }}</p>

                     

                     <form action="{{ route('employee.update',$employee->id) }}" method="POST" role="form" enctype="multipart/form-data">
                        @method('DELETE')
                        @csrf
                        <a href="/companies/{{ $employee->company_id }}" class="btn btn-primary">More About {{ $employee->company->name }}</a>
                        <a href="/employees/{{ $employee->id }}/edit" class="btn btn-warning">Edit Info</a>
                        <input type="submit" class="btn btn-danger" value="DELETE">
                        
                     </form>

                        
                  </div>
               </div>
            </div>
         </div>
    </div>
   </div>
   @endsection

</html>