function getReviewData(){
    axios.get('/getreviewtdata')
    .then(function(response){
        if(response.status==200){

            $('#minDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');

            $('#reviewDataTable').DataTable().destroy();
            $('#review_table').empty();


            var JSONDATA = response.data;
            $.each(JSONDATA, function(i, item) {
                $('<tr>').html(
                    "<td>"+JSONDATA[i].name+"</td>"+
                    "<td>"+JSONDATA[i].desc+"</td>"+
                    "<td> <a data-id="+JSONDATA[i].id+" class='revieweditebtn'><i class='fas fa-edit'></i></a> </td>"+
                    "<td> <a data-id="+JSONDATA[i].id+" class='reviewdeletebtn'><i class='fas fa-trash-alt'></i></a> </td>"
                ).appendTo('#review_table');
            });

            //Delete icon click
            $('.reviewdeletebtn').click(function(){
                var id = $(this).data('id');
                $('#reviewdeleteid').html(id);
                $('#deleteModal').modal('show');
            });

            //Edit button
            $('.revieweditebtn').click(function(){
                var id = $(this).data('id');
                reviewUpdateDetails(id);
                $('#reviewediteid').html(id);
                $('#reviewModal').modal('show');
            });

            $('#reviewDataTable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');

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

//Review modal delete click
$('#reviewDeleteConfirmBtn').click(function(){
    var id = $('#reviewdeleteid').html();
    getReviewtDelete(id);
})


//Review Delete Function
function getReviewtDelete(deleteIed){
    $('#reviewDeleteConfirmBtn').html("<div class='spinner-border text-primary' role='status'></div>"); //Animation
    axios.post('/reviewdelete', {id:deleteIed})
    .then(function(response){
        $('#reviewDeleteConfirmBtn').html('yes');
        if(response.status==200){
            if(response.data==1){
                $('#deleteModal').modal('hide');
                toastr.success('Delete successfully!');
                getReviewData();
            }else{
                $('#deleteModal').modal('hide');
                toastr.error('Delete failed!');
                getReviewData();
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


//Each Review updated details
function reviewUpdateDetails(detailId){
    axios.post('/reviewdetail', {id:detailId})
    .then(function(response){
        if(response.status==200){

            $('#reviewform').removeClass('d-none');
            $('#reviewloader').addClass('d-none');

            var jsonData = response.data;
            $('#reviewNameId').val(jsonData[0].name);
            $('#reviewDescId').val(jsonData[0].desc);
            $('#reviewImgId').val(jsonData[0].img);
        }
        else{
            $('#reviewloader').addClass('d-none');
            $('#reviewwrong').removeClass('d-none');
        }
    })
    .catch(function(error){
        $('#serviceeditloader').addClass('d-none');
        $('#serviceeditwrong').removeClass('d-none');
    });
}


//Course Edit Save button
$('#reviewConfirmBtn').click(function(){
    var id = $('#reviewediteid').html();
    var name = $('#reviewNameId').val();
    var desc = $('#reviewDescId').val();
    var img = $('#reviewImgId').val();
    reviewUpdate(id, name, desc, img);
});


//Review Update
function reviewUpdate(reviewId, reviewname, reviewdesc, reviewimg){
    if(reviewname.length==0){
        toastr.error('Review name is required!');
    }
    else if(reviewdesc.length==0){
        toastr.error('Review Desc is required!');
    }
    else if(reviewimg.length==0){
        toastr.error('Review image is required!');
    }
    
    else{
        $('#reviewConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); // Animation
        axios.post('/reviewupdate', {
            id:reviewId, name:reviewname, desc:reviewdesc, img:reviewimg
        })
        .then(function(response){
            $('#reviewConfirmBtn').html("Save");
            if(response.status==200){
                if(response.data==1){
                    $('#reviewModal').modal('hide');
                    toastr.success('Updated Success!');
                    getReviewData();
                }else{
                    $('#reviewModal').modal('hide');
                    toastr.error('Delete Failed!');
                    getReviewData();
                }
            }
            else{
                $('#reviewModal').modal('hide');
                toastr.error('Delete Failed!');
            }
        })
        .catch(function(error){
            $('#reviewModal').modal('hide');
            toastr.error('Something Went Wrong!');
        });
    }
}

$('#addnewReviewbtnid').click(function(){
    $('#addReviewModal').modal('show');
});


$('#reviewAddConfirmBtn').click(function(){
    var name = $('#revieweNameId').val();
    var desc = $('#revieweDesId').val();
    var img = $('#revieweImgId').val();

    reviewadded(name, desc, img);

});


//Course Added Method
function reviewadded(reviewname, reviewdesc, reviewimg){
    if(reviewname.length==0){
        toastr.error('Course name is required!');
    }
    else if(reviewdesc.length==0){
        toastr.error('Course Desc is required!');
    }
    else if(reviewimg.length==0){
        toastr.error('Course Fee is required!');
    }
    else{
        $('#reviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); // Animation
        axios.post('/reviewadded', {
            name:reviewname, desc:reviewdesc, img:reviewimg
        })
        .then(function(response){
            $('#reviewAddConfirmBtn').html("Save");
            if(response.status==200){
                if(response.data==1){
                    $('#addReviewModal').modal('hide');
                    toastr.success('Inserted Success!');
                    getReviewData();
                }else{
                    $('#addReviewModal').modal('hide');
                    toastr.error('Inserted Failed!');
                    getReviewData();
                }
            }
            else{
                $('#addReviewModal').modal('hide');
                toastr.error('Inserted Failed!');
            }
        })
        .catch(function(error){
            $('#addReviewModal').modal('hide');
            toastr.error('Something Went Wrong!');
        });
    }
}