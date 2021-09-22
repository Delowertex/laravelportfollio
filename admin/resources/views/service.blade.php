@extends('layout.app')
@section('title', 'Service')
@section('content')
<div class="container d-none" id="minDiv">
<div class="row">
<div class="p-5 col-md-12">

<button class="btn btn-danger btn-sm m-0 mb-3" id="addNewBtnId">Add New</button>
<table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
        <h6 class="d-none" id="servicedeleteid"></h6>
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
      <div class="modal-header">
        <h6 class="modal-title text-center">Update Service</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <h6 class="d-none" id="serviceediteid"></h6>
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

function getServiceData(){
    axios.get('/getservicdata')
        .then(function(response) {
        
        if(response.status==200){
            var jsonData = response.data;
            $('#minDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');

            $('#serviceDataTable').DataTable().destroy();
            $('#service_table').empty();

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td> <img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_desc + "</td>" +
                        "<td><a data-id=" +jsonData[i].id+ " class='serviceeditbtn'><i class='fas fa-edit'></i></a> </td>" +
                        "<td><a data-id=" +jsonData[i].id+ " class='servicedeletebtn'><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#service_table');
            });

            //Service table Delete button click
            $('.servicedeletebtn').click(function(){
                var id = $(this).data('id');
                $('#servicedeleteid').html(id);
                //$('#serviceDeleteConfirmBtn').attr('data-id', id);
                $('#deleteModal').modal('show');
            });

            //Service table  Edit button click
            $('.serviceeditbtn').click(function(){
                var id = $(this).data('id');
                $('#serviceediteid').html(id);
                editServiceDetail(id);
                $('#editeModal').modal('show');
            });

        }else{
            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        }    

        $('#serviceDataTable').DataTable({"order":false});
        $('.dataTables_length').addClass('bs-select');

        
    }).catch(function(error) {
        $('#loaderDiv').addClass('d-none');
        $('#wrongDiv').removeClass('d-none');
    });
}

//Service Delete click button
$('#serviceDeleteConfirmBtn').click(function(){
    var id = $('#servicedeleteid').html();
    getserviceDelete(id);
});

//Services Delete function
function getserviceDelete(deleteIed){
    $('#serviceDeleteConfirmBtn').html("<div class='spinner-border text-primary' role='status'></div>"); //Animation
    axios.post('/servicedelete', {id:deleteIed})
    .then(function(response){
        $('#serviceDeleteConfirmBtn').html('yes');
        if(response.status==200){
            if(response.data==1){
                $('#deleteModal').modal('hide');
                toastr.success('Delete successfully!');
                getServiceData();
            }else{
                $('#deleteModal').modal('hide');
                toastr.error('Delete failed!');
                getServiceData();
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


//Each service udate details 
function editServiceDetail(editid){
    axios.post('/servicedetail', {id:editid})
    .then(function(response){
        if(response.status==200){
            $('#serviceeditform').removeClass('d-none');
            $('#serviceeditloader').addClass('d-none');
            var JSONDATA = response.data;
            $('#servicenameid').val(JSONDATA[0].service_name);
            $('#servicedescid').val(JSONDATA[0].service_desc);
            $('#serviceimageid').val(JSONDATA[0].service_img);
        }
        else{
            $('#serviceeditloader').addClass('d-none');
            $('#serviceeditwrong').removeClass('d-none');
        }
    })
    .catch(function(error){
        $('#serviceeditloader').addClass('d-none');
        $('#serviceeditwrong').removeClass('d-none');
    });
}

//Update button on click
$('#serviceEditConfirmBtn').click(function(){
    var id = $('#serviceediteid').html();
    var name = $('#servicenameid').val();
    var desc = $('#servicedescid').val();
    var img = $('#serviceimageid').val();
    serviceUpdated(id, name, desc, img);
});


//Service Update
function serviceUpdated(serviceid, servicename, servicedesc, serviceimg){
    $('#serviceEditConfirmBtn').html("<div class='spinner-border' role='status'></div>");
    if(servicename.length==0){
        toastr.error('Hi! Name is required!');
    }else if(servicedesc.length==0){
        toastr.error('Hi! Description is required!');
    }else if(serviceimg.length==0){
        toastr.error('Hi! Image is required!');
    }else{
        axios.post('/serviceupdate', {id:serviceid, name:servicename, desc:servicedesc, img:serviceimg})
        .then(function(response){
        $('#serviceEditConfirmBtn').html("yes");
            if(response.status==200){
                if(response.data==1){
                    $('#editeModal').modal('hide');
                    toastr.success('Updated successfully!');
                    getServiceData();
                }else{
                    $('#editeModal').modal('hide');
                    toastr.error('Updated successfully!');
                    getServiceData(); 
                }
            }else{
                $('#editeModal').modal('hide');
                toastr.error('Something went wrong!');
            }
        })
        .catch(function(error){
            $('#editeModal').modal('hide');
            toastr.error('Something went wrong!');
        });
    }        
}

//Add Service
$('#addNewBtnId').click(function(){
    $('#addedModal').modal('show');
});

//Service add on click
$('#addNewmBtnId').click(function(){
    var name = $('#servicenameAddid').val();
    var desc = $('#servicedesAddcid').val();
    var img = $('#serviceimageAddid').val();
    serviceAdded(name, desc, img);
});

//Service add Method
function serviceAdded(serviceName, serviceDesc, serviceImg){
    axios.post('/serviceadded', {name:serviceName, desc:serviceDesc, img:serviceImg})
    .then(function(response){
        if(response.status==200){
            if(response.data==1){
                $('#addedModal').modal('hide');
                toastr.success('Inserted successfully!');
                getServiceData();
            }else{
                $('#addedModal').modal('hide');
                toastr.error('Inserted Failed!');
                getServiceData(); 
            }
        }else{
            $('#addedModal').modal('hide');
            toastr.error('Something Went Wrong!');
        }
    })
    .catch(function(error){
        $('#addedModal').modal('hide');
        toastr.error('Something Went Wrong!');
    });
}


</script>

@endsection