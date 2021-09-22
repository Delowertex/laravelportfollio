@extends('layout.app')
@section('title', 'Course')
@section('content')

<div id="mainDivCourse" class="container d-none">
<div class="row">
<div class="p-5 col-md-12">
<button id="addnewCoursebtnid" type="button" class="mx-0 my-3 btn btn-danger btn-sm">Add New</button>
<table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Fee</th>
	  <th class="th-sm">Class</th>
	  <th class="th-sm">Enroll</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="course_table">


	</tbody>
</table>

</div>
</div>
</div>


<!-- Add Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="text-center modal-body">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="mb-3 form-control" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="mb-3 form-control" placeholder="Course Description">
              <input id="CourseFeeId" type="text" id="" class="mb-3 form-control" placeholder="Course Fee">
              <input id="CourseEnrollId" type="text" id="" class="mb-3 form-control" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
              <input id="CourseClassId" type="text" id="" class="mb-3 form-control" placeholder="Total Class">      
              <input id="CourseLinkId" type="text" id="" class="mb-3 form-control" placeholder="Course Link">
              <input id="CourseImgId" type="text" id="" class="mb-3 form-control" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>





<div class="container" id="loaderDivCourse">
<div class="text-center row">
<div class="p-5 col-md-12">
<img class="m-5" src="{{asset('images/spinner.gif')}}" alt="">
</div>
</div>
</div>

<div class="container d-none" id="wrongDivCourse">
<div class="text-center row">
<div class="p-5 col-md-12">
<h1>Something Went Wrong!</h1>
</div>
</div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="text-center modal-body">
        <h6 class="m-4">Do you want to delete?</h6>
        <h6 id="couresedeleteid" class="m-4"></h6>
        <h6 id="coursedeleteid" class="d-none"></h6> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-mdb-dismiss="modal">
          No
        </button>
        <button id="courseDeleteConfirmBtn" type="button" class="btn btn-danger btn-sm">Yes</button>
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
        <h6 class="modal-title text-center">Update Course Modal</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="text-center modal-body">
      <h6 class="d-none" id="courseediteid"></h6>
       <div class="container d-none" id="coursedailsform">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameUpdateId" type="text" id="" class="mb-3 form-control" placeholder="Course Name">
          	 	<input id="CourseDesUpdateId" type="text" id="" class="mb-3 form-control" placeholder="Course Description">
              <input id="CourseFeeUpdateId" type="text" id="" class="mb-3 form-control" placeholder="Course Fee">
              <input id="CourseEnrollUpdateId" type="text" id="" class="mb-3 form-control" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
              <input id="CourseClassUpdateId" type="text" id="" class="mb-3 form-control" placeholder="Total Class">      
              <input id="CourseLinkUpdateId" type="text" id="" class="mb-3 form-control" placeholder="Course Link">
              <input id="CourseImgUpdateId" type="text" id="" class="mb-3 form-control" placeholder="Course Image">
       		</div>
       	</div>
       </div>

        <img id="courseeditloader" class="m-5" src="{{asset('images/spinner.gif')}}" alt="">
        <h3 id="courseeditwrong" class="d-none">Something Went Wrong!</h3>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
getCourseData()




//Services Page Table
function getCourseData() {
    axios.get('/getcoursedata')
        .then(function(response) {
            if(response.status==200){
                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');

                $('#courseDataTable').DataTable().destroy();
                $('#course_table').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td class='th-sm'>"+jsonData[i].course_name+"</td>" +    
                        "<td class='th-sm'>"+jsonData[i].course_fee+"</td>" +
                        "<td class='th-sm'>"+jsonData[i].course_totalenroll+"</td>" +
                        "<td class='th-sm'>"+jsonData[i].course_totalclass+"</td>" +
                        "<td><a data-id=" +jsonData[i].id+ " class='courseeditbtn'><i class='fas fa-edit'></i></a> </td>" +
                        "<td><a data-id=" +jsonData[i].id+ " class='coursedeletebtn'><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#course_table');

                });

                //Course Delete button
                $('.coursedeletebtn').click(function(){
                    var id = $(this).data('id');
                    $('#coursedeleteid').html(id);
                    $('#deleteCourseModal').modal('show');
                });

                //Edit button
                $('.courseeditbtn').click(function(){
                    var id = $(this).data('id');
                    CourseUpdateDetails(id);
                    $('#courseediteid').html(id);
                    $('#updateCourseModal').modal('show');
                });


                $('#courseDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');


            }else{
                $('#wrongDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');
            }


        }).catch(function(error) {
            $('#wrongDivCourse').removeClass('d-none');
            $('#loaderDivCourse').addClass('d-none');
    });
}

$('#addnewCoursebtnid').click(function(){
    $('#addCourseModal').modal('show');
});


$('#CourseAddConfirmBtn').click(function(){
    var name = $('#CourseNameId').val();
    var desc = $('#CourseDesId').val();
    var fee = $('#CourseFeeId').val();
    var enroll = $('#CourseEnrollId').val();
    var cclass = $('#CourseClassId').val();
    var link = $('#CourseLinkId').val();
    var img = $('#CourseImgId').val();

    CoursesAdd(name, desc, fee, enroll, cclass, link, img);

});


//Course Added Method
function CoursesAdd(coursename, coursedesc, coursefee, courseenroll, courseclass, courselink, courseimg){
    if(coursename.length==0){
        toastr.error('Course name is required!');
    }
    else if(coursedesc.length==0){
        toastr.error('Course Desc is required!');
    }
    else if(coursefee.length==0){
        toastr.error('Course Fee is required!');
    }
    else if(courseenroll.length==0){
        toastr.error('Course enroll is required!');
    }
    else if(courseclass.length==0){
        toastr.error('Course class is required!');
    }
    else if(courselink.length==0){
        toastr.error('Course link is required!');   
    }
    else if(courseimg.length==0){
        toastr.error('Course image is required!');
    }
    else{
        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); // Animation
        axios.post('/addcourse', {
            name:coursename, desc:coursedesc, fee:coursefee, enroll:courseenroll, tclass:courseclass, clink:courselink, img:courseimg
        })
        .then(function(response){
            $('#CourseAddConfirmBtn').html("Save");
            if(response.status==200){
                if(response.data==1){
                    $('#addCourseModal').modal('hide');
                    toastr.success('Inserted Success!');
                    getCourseData();
                }else{
                    $('#addCourseModal').modal('hide');
                    toastr.error('Inserted Failed!');
                    getCourseData();
                }
            }
            else{
                $('#addCourseModal').modal('hide');
                toastr.error('Inserted Failed!');
            }
        })
        .catch(function(error){
            $('#addCourseModal').modal('hide');
            toastr.error('Something Went Wrong!');
        });
    }
}


//Course delete click btn
$('#courseDeleteConfirmBtn').click(function(){
    var id = $('#coursedeleteid').html();
    courseDelete(id);
});

//Course delete
function courseDelete(deleteId){
    $('#courseDeleteConfirmBtn').html("<div class='spinner-border text-primary' role='status'></div>"); // Animation
    axios.post('/deleteservice', {id:deleteId})
    .then(function(response){
        $('#courseDeleteConfirmBtn').html("yes");
        if(response.status==200){
            if(response.data==1){
                $('#deleteCourseModal').modal('hide');
                toastr.success('Delete Success!');
                getCourseData();
            }else{
                $('#deleteCourseModal').modal('hide');
                toastr.error('Delete Failed thing!');
                getCourseData();
            }
        }else{
            $('#deleteCourseModal').modal('hide');
            toastr.error('Delete Failed some!');
        }
        
    })
    .catch(function(error){
        $('#deleteCourseModal').modal('hide');
        toastr.error('Something went wrong!');
    });
}


//Each Course updated details
function CourseUpdateDetails(detailId){
    axios.post('/coursdetail', {id:detailId})
    .then(function(response){
        if(response.status==200){
            $('#coursedailsform').removeClass('d-none');
            $('#courseeditloader').addClass('d-none');
            var jsonData = response.data;
            $('#CourseNameUpdateId').val(jsonData[0].course_name);
            $('#CourseDesUpdateId').val(jsonData[0].course_des);
            $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
            $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
            $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
            $('#CourseLinkUpdateId').val(jsonData[0].course_link);
            $('#CourseImgUpdateId').val(jsonData[0].course_img);
        }
        else{
            $('#courseeditloader').addClass('d-none');
            $('#courseeditwrong').removeClass('d-none');
        }
    })
    .catch(function(error){
        $('#serviceeditloader').addClass('d-none');
        $('#serviceeditwrong').removeClass('d-none');
    });
}


//Course Edit Save button
$('#CourseUpdateConfirmBtn').click(function(){
    var id = $('#courseediteid').html();
    var name = $('#CourseNameUpdateId').val();
    var desc = $('#CourseDesUpdateId').val();
    var fee = $('#CourseFeeUpdateId').val();
    var enroll = $('#CourseEnrollUpdateId').val();
    var tclass = $('#CourseClassUpdateId').val();
    var link = $('#CourseLinkUpdateId').val();
    var img = $('#CourseImgUpdateId').val();
    CourseUpdate(id, name, desc, fee, enroll, tclass, link, img);
});


//Course Update
function CourseUpdate(courseId, coursename, coursedesc, coursefee, courseenroll, courseclass, courselink, courseimg){
    if(coursename.length==0){
        toastr.error('Course name is required!');
    }
    else if(coursedesc.length==0){
        toastr.error('Course Desc is required!');
    }
    else if(coursefee.length==0){
        toastr.error('Course image is required!');
    }
    
    else if(courseenroll.length==0){
        toastr.error('Course Desc is required!');
    }
    else if(courseclass.length==0){
        toastr.error('Course image is required!');
    }
    
    else if(courselink.length==0){
        toastr.error('Course Desc is required!');
    }
    else if(courseimg.length==0){
        toastr.error('Course image is required!');
    }else{
        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); // Animation
        axios.post('/updatecourse', {
            id:courseId, name:coursename, desc:coursedesc, fee:coursefee, enroll:courseenroll, cclass:courseclass, link:courselink, img:courseimg
        })
        .then(function(response){
            $('#serviceEditConfirmBtn').html("Save");
            if(response.status==200){
                if(response.data==1){
                    $('#updateCourseModal').modal('hide');
                    toastr.success('Updated Success!');
                    getCourseData();
                }else{
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Delete Failed!');
                    getCourseData();
                }
            }
            else{
                $('#updateCourseModal').modal('hide');
                toastr.error('Delete Failed!');
            }
        })
        .catch(function(error){
            $('#updateCourseModal').modal('hide');
            toastr.error('Something Went Wrong!');
        });
    }
}





</script>
@endsection