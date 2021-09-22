@extends('layout.app')

@section('content')
<div class="container d-none" id="minDiv">
<div class="row">
<div class="p-5 col-md-12">

<button class="btn btn-danger btn-sm m-0 mb-3" id="addNewBtnId">Add New</button>
<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="service_table">

	
  </tbody>
</table>

</div>
</div>
</div>


<div class="container" id="loaderDiv">
<div class="row">
<div class="p-5 col-md-12 text-center">

<img  src="{{asset('images/spinner.gif')}}" alt="">

</div>
</div>
</div>

<div class="container d-none" id="wrongDiv">
<div class="row">
<div class="p-5 col-md-12 text-center">

<h1>Something Went Wrong</h1>

</div>
</div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="text-center modal-body">
        <h6 class="m-4">Do you want to delete?</h6>
        <h6 id="servicedeleteid"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-mdb-dismiss="modal">
          No
        </button>
        <button id="serviceDeleteConfirmBtn" type="button" class="btn btn-danger btn-sm">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- Edit Modal -->
<div class="modal fade" id="editeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="text-center modal-body">
        <h6 id="serviceediteid"></h6>
        <div id="serviceeditform" class="d-none w-100">
          <input type="text" id="servicenameid" class="form-control" placeholder="Enter Service Name" /><br>
          <input type="text" id="servicedescid" class="form-control" placeholder="Enter Service Desc" /><br>
          <input type="text" id="serviceimageid" class="form-control" placeholder="Enter Service Image" /><br>
        </div>
        <img id="serviceeditloader" class="m-5" src="{{asset('images/spinner.gif')}}" alt="">
        <h3 id="serviceeditwrong" class="d-none">Something Went Wrong!</h3>
      </div>
      <div class="modal-footer">
        <button id="serviceEditCencelmBtn" type="button" class="btn btn-primary btn-sm" data-mdb-dismiss="modal">
          Cencel
        </button>
        <button id="serviceEditConfirmBtn" type="button" class="btn btn-danger btn-sm">Save</button>
      </div>
    </div>
  </div>
</div>



<!-- Add Modal -->
<div class="modal fade" id="addedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="text-center modal-body">
        <div id="serviceaddedform" class="w-100">
          <h6 class="p-3">Add New Service</h6>
          <input type="text" id="servicenameAddid" class="form-control" placeholder="Enter Service Name" /><br>
          <input type="text" id="servicedesAddcid" class="form-control" placeholder="Enter Service Desc" /><br>
          <input type="text" id="serviceimageAddid" class="form-control" placeholder="Enter Service Image" /><br>
        </div>
        <!-- <img id="serviceeditloader" class="m-5" src="{{asset('images/spinner.gif')}}" alt="">
        <h3 id="serviceeditwrong" class="">Something Went Wrong!</h3> -->
      </div>
      <div class="modal-footer">
        <button id="serviceEditCencelmBtn" type="button" class="btn btn-primary btn-sm" data-mdb-dismiss="modal">
          Cencel
        </button>
        <button id="addNewmBtnId" type="button" class="btn btn-danger btn-sm">Add New</button>
      </div>
    </div>
  </div>
</div>




@endsection

@section('script')

<script type="text/javascript">


getServiceData();



</script>

@endsection