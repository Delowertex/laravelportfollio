@extends('layout.app')
@section('title', 'Review')
@section('content')
<div class="d-none container" id="minDiv">
    <div class="row">
        <div class="p-5 col-md-12">
        <button id="addnewReviewbtnid" type="button" class="mx-0 my-3 btn btn-danger btn-sm">Add New</button>
            <table id="reviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="review_table">

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


<div class="d-none container" id="wrongDiv">
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
        <h6 class="" id="reviewdeleteid"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-mdb-dismiss="modal">
          No
        </button>
        <button id="reviewDeleteConfirmBtn" type="button" class="btn btn-danger btn-sm">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title text-center">Update Review Modal</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="text-center modal-body">
      <h6 class="" id="reviewediteid"></h6>
       <div class="d-none container" id="reviewform">
       	<div class="row">
       		<div class="col-md-12">
             	<input id="reviewNameId" type="text" id="" class="mb-3 form-control" placeholder="Review Name">
          	 	<input id="reviewDescId" type="text" id="" class="mb-3 form-control" placeholder="Review Description">
                <input id="reviewImgId" type="text" id="" class="mb-3 form-control" placeholder="Review Image">
       		</div>
       	</div>
       </div>
        <img id="reviewloader" class="m-5" src="{{asset('images/spinner.gif')}}" alt="">
        <h3 id="reviewwrong" class="d-none">Something Went Wrong!</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="reviewConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



<!-- Add Modal -->
<div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="text-center modal-body">
       <div class="container">
       	<div class="row">
       		<div class="col-md-12">
             	<input id="revieweNameId" type="text" id="" class="mb-3 form-control" placeholder="reviewe Name">
          	 	<input id="revieweDesId" type="text" id="" class="mb-3 form-control" placeholder="reviewe Description">
                <input id="revieweImgId" type="text" id="" class="mb-3 form-control" placeholder="reviewe Img">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="reviewAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@endsection


@section('script')
<script type="text/javascript">

getReviewData();


</script>


@endsection