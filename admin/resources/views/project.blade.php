@extends('layout.app')
@section('title', 'Project')
@section('content')
<div class="container d-none" id="minDiv">
    <div class="row">
        <div class="p-5 col-md-12">

        <button class="btn btn-danger btn-sm m-0 mb-3" id="addNewItemProdect">Add New</button>
        <table id="projectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Description</th>
                    <th class="th-sm">Edit</th>
                    <th class="th-sm">Delete</th>
                </tr>
            </thead>
            <tbody id="project_table">

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
        <h6 class="" id="projectdeleteid"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-mdb-dismiss="modal">
          No
        </button>
        <button id="projectDeleteConfirmBtn" type="button" class="btn btn-danger btn-sm">Yes</button>
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
        <h6 class="modal-title text-center">Update Project</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <h6 class="" id="projectediteid"></h6>
        <div id="projecteditform" class="d-none w-100">
          <input type="text" id="projectnameid" class="form-control" placeholder="Enter project Name" /><br>
          <input type="text" id="projectdescid" class="form-control" placeholder="Enter project Desc" /><br>
        </div>
        <img id="projectloader" class="m-5" src="{{asset('images/spinner.gif')}}" alt="">
        <h3 id="projectwrong" class="d-none">Something Went Wrong!</h3>
      </div>
      <div class="modal-footer">
        <button id="serviceEditCencelmBtn" type="button" class="btn btn-primary btn-sm" data-mdb-dismiss="modal">
          Cencel
        </button>
        <button id="projectConfirmBtn" type="button" class="btn btn-danger btn-sm">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- Add Modal -->
<div class="modal fade" id="addnewItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="text-center modal-body">
        <div id="productaddedform" class="w-100">
          <h6 class="p-3">Add New Product</h6>
          <input type="text" id="productnameAddid" class="form-control" placeholder="Enter product Name" /><br>
          <input type="text" id="productdesAddcid" class="form-control" placeholder="Enter product Desc" /><br>
        </div>
      </div>
      <div class="modal-footer">
        <button id="productEditCencelmBtn" type="button" class="btn btn-primary btn-sm" data-mdb-dismiss="modal">
          Cencel
        </button>
        <button id="addProductBtnId" type="button" class="btn btn-danger btn-sm">Add New</button>
      </div>
    </div>
  </div>
</div>




@endsection


@section('script')
<script type="text/javascript">

getProjectData();



function getProjectData(){
    axios.get('/getprojectdata')
    .then(function(response){
        if(response.status==200){
            $('#minDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');


            $('#project_table').empty();

            var JSONDATA = response.data;
            $.each(JSONDATA, function(i, item) {
                $('<tr>').html(
                    "<td>"+JSONDATA[i].project_name+"</td>"+
                    "<td>"+JSONDATA[i].project_desc+"</td>"+
                    "<td> <a data-id="+JSONDATA[i].id+" class='projecteditbtn'><i class='fas fa-edit'></i></a> </td>"+
                    "<td> <a data-id="+JSONDATA[i].id+" class='projectdeletebtn'><i class='fas fa-trash-alt'></i></a> </td>"
                ).appendTo('#project_table');
            });

            //Delete icon click
            $('.projectdeletebtn').click(function(){
                var id = $(this).data('id');
                $('#projectdeleteid').html(id);
                $('#deleteModal').modal('show');
            });

            //Edit icon click
            $('.projecteditbtn').click(function(){
                var id = $(this).data('id');
                $('#projectediteid').html(id);
                updateProjectDetail(id);
                $('#editeModal').modal('show');
            });

        }else{
            $('#wrongDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');
        }
    })
    .catch(function(error){
        $('#wrongDiv').removeClass('d-none');
        $('#loaderDiv').addClass('d-none');
    });
}

//Project modal delete click
$('#projectDeleteConfirmBtn').click(function(){
    var id = $('#projectdeleteid').html();
    getProjectDelete(id);
})


//Project Delete Function
function getProjectDelete(deleteIed){
    $('#projectDeleteConfirmBtn').html("<div class='spinner-border text-primary' role='status'></div>"); //Animation
    axios.post('/projectdelete', {id:deleteIed})
    .then(function(response){
        $('#projectDeleteConfirmBtn').html('yes');
        if(response.status==200){
            if(response.data==1){
                $('#deleteModal').modal('hide');
                toastr.success('Delete successfully!');
                getProjectData();
            }else{
                $('#deleteModal').modal('hide');
                toastr.error('Delete failed!');
                getProjectData();
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


//Each Product udate details 
function updateProjectDetail(detailsid){
    axios.post('/projectdetail', {id:detailsid})
    .then(function(response){
        if(response.status==200){
            $('#projecteditform').removeClass('d-none');
            $('#projectloader').addClass('d-none');
            var JSONDATA = response.data;
            $('#projectnameid').val(JSONDATA[0].project_name);
            $('#projectdescid').val(JSONDATA[0].project_desc);
        }
        else{
            $('#projectwrong').removeClass('d-none');
            $('#projectloader').addClass('d-none');
        }
    })
    .catch(function(error){
        $('#projectwrong').removeClass('d-none');
        $('#projectloader').addClass('d-none');
    });
}


//Project Update click
$('#projectConfirmBtn').click(function(){
    var id = $('#projectediteid').html();
    var name = $('#projectnameid').val();
    var desc = $('#projectdescid').val();
    projectUpdated(id, name, desc);
});

//project Update
function projectUpdated(projectid, projectname, projectdesc){
    $('#projectConfirmBtn').html("<div class='spinner-border' role='status'></div>");
    if(projectname.length==0){
        toastr.error('Hi! Name is required!');
    }else if(projectdesc.length==0){
        toastr.error('Hi! Description is required!');
    }else{
        axios.post('/projectupdate', {id:projectid, name:projectname, desc:projectdesc})
        .then(function(response){
        $('#projectConfirmBtn').html("yes");
            if(response.status==200){
                if(response.data==1){
                    $('#editeModal').modal('hide');
                    toastr.success('Updated successfully!');
                    getProjectData();
                }else{
                    $('#editeModal').modal('hide');
                    toastr.error('Updated successfully!');
                    getProjectData(); 
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

//Add Product
$('#addNewItemProdect').click(function(){
    $('#addnewItem').modal('show');
});

//Product add on click
$('#addProductBtnId').click(function(){
    var name = $('#productnameAddid').val();
    var desc = $('#productdesAddcid').val();

    productsAdded(name, desc);
});

//Product add Method
function productsAdded(productName, productDesc){
    axios.post('/productadded', {name:productName, desc:productDesc})
    .then(function(response){
        if(response.status==200){
            if(response.data==1){
                $('#addnewItem').modal('hide');
                toastr.success('Inserted successfully!');
                getProjectData();
            }else{
                $('#addnewItem').modal('hide');
                toastr.error('Inserted Failed!');
                getProjectData(); 
            }
        }else{
            $('#addnewItem').modal('hide');
            toastr.error('Something Went Wronggggg!');
        }
    })
    .catch(function(error){
        $('#addnewItem').modal('hide');
        toastr.error('Something Went Wrong!');
    });
}
    
</script>
@endsection