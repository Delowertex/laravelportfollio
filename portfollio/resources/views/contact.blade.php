@extends('layout.app')
@section('title', 'Contact')
@section('content')

    <div class="container-fluid jumbotron mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6  text-center">
                <h1 class="page-top-title mt-3">- Contact Us -</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3654.0937373302154!2d90.45399901451289!3d23.672605584627743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b753e7bf57f9%3A0x3d28bf7989732901!2s100%20Rasulpur%20W%20Rd%2C%20Fatullah!5e0!3m2!1sen!2sbd!4v1632150931196!5m2!1sen!2sbd"
                        width="510" height="360" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-md-6">
                <h3 class="service-card-title">ঠিকানা</h3>
                <hr>
                <p class="footer-text"><i class="fas fa-map-marker-alt"></i> শেখেরটেক ৮ মোহাম্মদপুর, ঢাকা <i class="fas fa-phone"></i>
                    ০১৭৮৫৩৮৮৯১৯ <i class="fas fa-envelope"></i> Rabbil@Yahoo.com</p>
                <p class="footer-text"></p>
                <p class="footer-text"><i class="fas fa-envelope"></i> Rabbil@Yahoo.com</p>
                <div class="form-group ">
                    <input id="contactname" type="text" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="contactmobile" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="contactemail" type="text" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="contactmsg" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <button id="contactSendBtn" type="submit" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
            </div>
        </div>
    </div>


@endsection
