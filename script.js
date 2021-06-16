$(document).ready(function(){
    $(window).scroll(function(){
        // sticky navbar on scroll script
        if(this.scrollY > 20){
            $('.navbar').addClass("sticky");
        }else{
            $('.navbar').removeClass("sticky");
        }
        
        // scroll-up button show/hide script
        if(this.scrollY > 500){
            $('.scroll-up-btn').addClass("show");
        }else{
            $('.scroll-up-btn').removeClass("show");
        }
    });

    // slide-up script
    $('.scroll-up-btn').click(function(){
        $('html').animate({scrollTop: 0});
        // removing smooth scroll on slide-up button click
        $('html').css("scrollBehavior", "auto");
    });

    $('.navbar .menu li a').click(function(){
        // applying again smooth scroll on menu items click
        $('html').css("scrollBehavior", "smooth");
    });

    // toggle menu/navbar script
    $('.menu-btn').click(function(){
        $('.navbar .menu').toggleClass("active");
        $('.menu-btn i').toggleClass("active");
    });

    // typing text animation script
    var typed = new Typed(".typing", {
        strings: ["YouTuber", "Developer", "Blogger", "Designer", "Freelancer"],
        typeSpeed: 100,
        backSpeed: 60,
        loop: true
    });

    var typed = new Typed(".typing-2", {
        strings: ["YouTuber", "Developer", "Blogger", "Designer", "Freelancer"],
        typeSpeed: 100,
        backSpeed: 60,
        loop: true
    });

    // owl carousel script
    $('.carousel').owlCarousel({
        margin: 20,
        loop: true,
        autoplayTimeOut: 2000,
        autoplayHoverPause: true,
        responsive: {
            0:{
                items: 1,
                nav: false
            },
            600:{
                items: 2,
                nav: false
            },
            1000:{
                items: 3,
                nav: false
            }
        }
    });
});










function sendEmail(event) {
    event.preventDefault();
    let name = $("#name");
    let email = $("#email");
    let subject = $("#subject");
    let message = $("#message");
    
    if (isNotEmpty(name) && validateEmail(email, email.val()) && isNotEmpty(subject) && isNotEmpty(message)) {
        $.ajax({
            url: 'sendEmail.php',
            method: 'POST',
            dataType: 'json',
            data: {
                name: name.val(),
                email: email.val(),
                subject: subject.val(),
                message: message.val()
            },
            success: function(response) {
                $("#form")[0].reset();
                $(".sent-notification").text("Thank you, this message has been sent.");
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
            
        }) 
    }
    else {
        $(".sent-notification").text("Form has not been sent, please enter your information correctly.");
    }
}

function isNotEmpty(inputField) {
    if(inputField.val() == "") {
        inputField.css('borderBottom', '4px solid #9F2929');
        return false;
    }
    else 
    {
        inputField.css('border', '');
        return true;
    }
}

function validateEmail(mailInputField, mailInputFieldVal) {
    if (mailInputFieldVal.includes('@')) {
        return true;
    }
    else {
        mailInputField.css('borderBottom', '4px solid #9F2929');
        return false;
    }
}
