
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
         var company_id={{ $company->id }};   
         console.log(tag_name,company_id);
         jQuery.ajax({
            url: "/api/tags/company/"+tag_name+"/"+company_id,
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
         var company_id={{ $company->id }};   
         console.log(tag_name,company_id);
         jQuery.ajax({
            url: "/api/tags/company/"+tag_name+"/"+company_id,
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
         var company_id = {{ $company->id}};
         console.log(company_id);
          $("#tags").load("http://firsttask2.test/api/tags/company/"+company_id);
      }

   </script>
   @endsection