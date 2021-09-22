@extends('layout.app')
@section('title', 'Content')
@section('content')
<div class="d-none container" id="minDiv">
    <div class="row">
        <div class="p-5 col-md-12">
            <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Mobile</th>
                        <th class="th-sm">Email</th>
                        <th class="th-sm">Message</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="contact_table">

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
        <h6 class="" id="contactdeleteid"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-mdb-dismiss="modal">
          No
        </button>
        <button id="contactDeleteConfirmBtn" type="button" class="btn btn-danger btn-sm">Yes</button>
      </div>
    </div>
  </div>
</div>


@endsection


@section('script')
<script type="text/javascript">

getContactData();




function getContactData(){
    axios.get('/getcontactdata')
    .then(function(response){
        if(response.status==200){

            $('#minDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');

            $('#contactDataTable').DataTable().destroy();

            $('#contact_table').empty();

            var JSONDATA = response.data;
            $.each(JSONDATA, function(i, item) {
                $('<tr>').html(
                    "<td>"+JSONDATA[i].contact_name+"</td>"+
                    "<td>"+JSONDATA[i].contact_mobile+"</td>"+
                    "<td>"+JSONDATA[i].contact_email+"</td>"+
                    "<td>"+JSONDATA[i].contact_msg+"</td>"+
                    "<td> <a data-id="+JSONDATA[i].id+" class='contactdeletebtn'><i class='fas fa-trash-alt'></i></a> </td>"
                ).appendTo('#contact_table');
            });

            //Delete icon click
            $('.contactdeletebtn').click(function(){
                var id = $(this).data('id');
                $('#contactdeleteid').html(id);
                $('#deleteModal').modal('show');
            });

            

        }else{
            $('#wrongDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');
        }

        $('#contactDataTable').DataTable({"order":false});
        $('.dataTables_length').addClass('bs-select');
    })
    .catch(function(error){
        $('#wrongDiv').removeClass('d-none');
        $('#loaderDiv').addClass('d-none');
    });
}


//Contact modal delete click
$('#contactDeleteConfirmBtn').click(function(){
    var id = $('#contactdeleteid').html();
    getContactDelete(id);
})


//Contact Delete Function
function getContactDelete(deleteIed){
    $('#contactDeleteConfirmBtn').html("<div class='spinner-border text-primary' role='status'></div>"); //Animation
    axios.post('/contactdelete', {id:deleteIed})
    .then(function(response){
        $('#contactDeleteConfirmBtn').html('yes');
        if(response.status==200){
            if(response.data==1){
                $('#deleteModal').modal('hide');
                toastr.success('Delete successfully!');
                getContactData();
            }else{
                $('#deleteModal').modal('hide');
                toastr.error('Delete failed!');
                getContactData();
            }
        }else{
            $('#deleteModal').modal('hide');
            toastr.error('Something went wrong!');
        }
        
    })
    .catch(function(error){
        $('#deleteModal').modal('hide');
        toastr.error('Deleted failed!');
    });
}
    
</script>
@endsection