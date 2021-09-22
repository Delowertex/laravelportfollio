// Owl Carousel Start..................



$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});


// Owl Carousel End..................

//Contact send

$('#contactSendBtn').click(function(){
    var name = $('#contactname').val();
    var mobile = $('#contactmobile').val();
    var email = $('#contactemail').val();
    var msg = $('#contactmsg').val();
    sendContact(name, mobile, email, msg)

});


function sendContact(contactName, contactMobile, contactEmail, contactMsg){
    if(contactName.length==0){
        $('#contactSendBtn').html('Enter your name');
        setTimeout(function(){
            $('#contactSendBtn').html('Send');
        }, 2000);
    }else if(contactMobile.length==0){
        $('#contactSendBtn').html('Enter your Mobile');
        setTimeout(function(){
            $('#contactSendBtn').html('Send');
        }, 2000);
    }else if(contactEmail.length==0){
        $('#contactSendBtn').html('Enter your Email');
        setTimeout(function(){
            $('#contactSendBtn').html('Send');
        }, 2000);
    }else if(contactMsg.length==0){
        $('#contactSendBtn').html('Enter your Message');
        setTimeout(function(){
            $('#contactSendBtn').html('Send');
        }, 2000);
    }else{
    $('#contactSendBtn').html('Sending....');
        axios.post('/contactSend', {
            name:contactName,
            mobile:contactMobile,
            email:contactEmail,
            msg:contactMsg
        })
        .then(function(response){
            if(response.status==200){
                if(response.data==1){
                    $('#contactSendBtn').html('Request Success!');
                    setTimeout(function(){
                        $('#contactSendBtn').html('Sent');
                    }, 3000);
                }else{
                    $('#contactSendBtn').html('Failed! Try Again!');
                    setTimeout(function(){
                        $('#contactSendBtn').html('Sent');
                    }, 3000);
                }
            }else{
                $('#contactSendBtn').html('Failed! Try Again!');
                setTimeout(function(){
                    $('#contactSendBtn').html('Sent');
                }, 3000);
            }
        })
        .catch(function(error){
            $('#contactSendBtn').html('Try Again!');
            setTimeout(function(){
                $('#contactSendBtn').html('Sent');
            }, 3000);
        });
    }

}
