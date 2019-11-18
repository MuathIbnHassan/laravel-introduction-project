
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
               <div class="card bg-light text-dark">
                  <div onload="getTags()" class="card-header" id="tags">
                     <span>Loading Tags ..</span>
                  </div>
                  <div class="card">
                     
                     <button onclick="disableAddButton();" type="button" class="btn btn-warning" data-toggle="collapse" data-target="#addTagCollapse" id="addTagCollapseButton">Add Tag
                        <div id="addTagCollapse" class="collapse">
                           Tag Name:
                           <input type="text" class="form-control" id="add_tag_name">
                           <a onclick="setTag()" href="#" class="btn btn-primary" id="addTag">Add Tag</a>

                        </div>
                     </button>

                     <button onclick="disableDelButton()" type="button" class="btn btn-danger" data-toggle="collapse" data-target="#delTagCollapse" id="delTagCollapseButton">Delete Tag
                        <div id="delTagCollapse" class="collapse">
                           Tag Name:
                           <input type="text" class="form-control" id="del_tag_name">
                           <a onclick="delTag()" href="#" class="btn btn-primary" id="delTag">Delete Tag</a>

                        </div>
                     </button>
                     
                  </div>
               </div>
            </div>
         </div>
    </div>
   </div>
    <script type="application/javascript">

      function disableAddButton() {
         $('#addTagCollapseButton').attr("disabled", true);
         $("#addTagCollapse").addClass("show");    //aria-expanded="true"
      }
      function disableDelButton() {
         $('#delTagCollapseButton').attr("disabled", true);
         $("#delTagCollapse").addClass("show");    //aria-expanded="true"
      }

      function setTag() {
         var tag_name = $("#add_tag_name").val()
         var employee_id ={{ $employee->id }};   
         console.log(tag_name,employee_id);
         jQuery.ajax({
            url: "/api/tags/employee/"+tag_name+"/"+employee_id,
            type: "post",
         })
         .done(function(data, textStatus, jqXHR) {
            console.log("HTTP Request Succeeded: " + jqXHR.status);
            console.log(data);
             $('#addTagCollapseButton').attr("disabled", false);
            $("#addTagCollapse").removeClass("show");
            getTags()
         })
         .fail(function(jqXHR, textStatus, errorThrown) {
            console.log("HTTP Request Failed");
            
         })
         .always(function() {
            /* ... */
         });         
      }

      function delTag() {
         var tag_name = $("#del_tag_name").val()
         var employee_id={{ $employee->id }};   
         console.log(tag_name,employee_id);
         jQuery.ajax({
            url: "/api/tags/employee/"+tag_name+"/"+employee_id,
            type: "DELETE",
         })
         .done(function(data, textStatus, jqXHR) {
            console.log("HTTP Request Succeeded: " + jqXHR.status);
            console.log(data);
             $('#delTagCollapseButton').attr("disabled", false);
            $("#delTagCollapse").removeClass("show");
            getTags()
         })
         .fail(function(jqXHR, textStatus, errorThrown) {
            console.log("HTTP Request Failed");
            
         })
         .always(function() {
            /* ... */
         });         
      }

      $(document).ready(function(){
            getTags();
      });

      function getTags() {
         var employee_id = {{ $employee->id}};
         console.log(employee_id);
          $("#tags").load("http://firsttask2.test/api/tags/employee/"+employee_id);
      }

   </script>
   @endsection

</html>