

<div class="container mt-5">
    <div class="row">

        @foreach($courses as $courses)
        <div class="col-md-4 p-1 text-center">
            <div class="card">
                <div class="text-center">
                    <img class="w-100" src="{{$courses->course_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">{{$courses->course_name}}</h5>
                    <h6 class="service-card-subTitle p-0 ">{{$courses->course_des}} </h6>
                    <h6 class="service-card-subTitle p-0 ">{{$courses->course_fee}} </h6>
                    <h5 class="service-card-title mt-4">{{$courses->course_totalenroll}}</h5>
                    <h6 class="service-card-subTitle p-0 ">{{$courses->course_totalclass}} </h6>
                    <h6 class="service-card-subTitle p-0 ">{{$courses->course_link}} </h6>
                    <a target="_blank" href="{{$courses->course_link}}" class="normal-btn-outline mt-2 mb-4 btn">শুরু করুন </a>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
