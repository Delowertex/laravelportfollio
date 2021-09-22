@extends('layout.app')

@section('title', 'Gallery')

@section('content')
<div id="mainDivCourse" class="container">
<div class="row">
<div class="p-3 col-md-12">
<button id="addnewGallery" type="button" class="mx-0 my-3 btn btn-danger btn-sm">Add New</button>
<table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">

</table>

</div>
</div>
</div>

<div id="mainDivCourse" class="container"> 
  <div class="row photoRow">

  </div>
  <button class="btn btn-sm btn-primary" id="LoadMoreBtn"> Load More </button>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addGalleryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Gallery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="text-center modal-body">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                        <input type="file" id="imgInput">
                        <img src="{{asset('images/default_image.png')}}" id="imgpreview" alt="" class="imagepreview mt-3">
                  </div>
              </div>
          </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="savephoto" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection 

@section('script')
<script type="text/javascript">


$('#addnewGallery').click(function(){
    $('#addGalleryModal').modal('show');
});


$('#imgInput').change(function(){
    var reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload = function(event){
        var imgSourse = event.target.result;
        $('#imgpreview').attr('src', imgSourse);
    }
});


$('#savephoto').on('click', function(){

    $('#savephoto').html("<div class='spinner-border text-primary' role='status'></div>")

    var photofile = $('#imgInput').prop('files')[0];
    var formdata = new FormData();
    formdata.append('photo', photofile);

    axios.post('/uploadphoto', formdata).then(function(response){
      if(response.status==200 && response.data==1){
          $('#addGalleryModal').modal('hide');
          $('#savephoto').html('save');
          toastr.success('Photo Upload success!');
      }else{
        $('#addGalleryModal').modal('hide');
        toastr.error('Photo Upload failed!');
      }
        
    })
    .catch(function(error){
      $('#addGalleryModal').modal('hide');
        toastr.error('Photo Upload failed!');
        $('#savephoto').html('save');
    });
});


loadPhoto();

function loadPhoto(firstimgid){
    let imgid = firstimgid + 3; 
    let url = "/PhotoJsonbyid"+imgid;
    
    axios.get('/url').then(function(response){
    var JSONDATA = response.data;
    $.each(JSONDATA, function(i, item) {
      $("<div class='col-md-3'>").html(
      "<img data-id="+item['id']+" class='rowimg' src="+item['location']+">"
      ).appendTo('.photoRow');
    });
  })
  .catch(function(error){

  });
}

$('#loadMoreBtn').on('click', function(){
  let firstid = $(this).closest('div').find('img').data('id');
  alert($id);

  laodById(firstid);
});




</script>

@endsection

