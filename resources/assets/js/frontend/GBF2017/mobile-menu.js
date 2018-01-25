$(document).ready(function() {
    // Trigger mobile menu on click
    $('.menuBtn').click(function() {
        $(this).toggleClass('act');
        if($(this).hasClass('act')) {
            $('.mainMenu').addClass('act');
        } else {
            $('.mainMenu').removeClass('act');
        }
    });

    // Remove current class from anchor tag on mobile menu
    if (window.innerWidth <= 767) {
        $(".navbar-nav li a").removeClass("current");
    }

    // Add sticky header on page ready
    var scroll = $(window).scrollTop();

    if (scroll > '20') {
        $('.menuBtn').addClass('active');
    } else if (scroll < '20') {
        $('.menuBtn').removeClass('active');
    }

    // Dropdown menu on hover displayed > 768 and on click < 767
    $(".mainMenu .dropdown").mouseover(function() {
        if($(window).width() > 768) {
            $(this).addClass("open");
        }
    });

    $(".dropdown-submenu").mouseover(function() {
        if($(window).width() > 768) {
            $(this).addClass("open");
        }
    });

    $(".mainMenu .dropdown").mouseleave(function() {
        if($(window).width() > 768) {
            $(this).removeClass("open");
            $(this).find(".open").removeClass("open");
        }
    });

    $(".dropdown-submenu").click(function() {
        $(this).toggleClass("open");
        $(this).find(".open").removeClass("open");
        return false;
    });

    $(".dropdown a").click(function() {
        if( $(this).parents(".dropdown ").hasClass("open"))
        {
            window.location.replace($(this).attr('href'));
        }
        else {
            $(this).parents(".dropdown ").addClass("open");
        }
        return false;
    });
});

$(window).scroll(function() {
    // Add sticky header on scroll
    var scroll = $(window).scrollTop();
    if (scroll > '20') {
        $('.menuBtn').addClass('active');
    } else if (scroll < '20') {
        $('.menuBtn').removeClass('active');
    }
    var a = $(".hero-image").offset().top + $(".hero-image").height();
    if (scroll > a) {
        $('.menu').addClass('active');
    } else if (scroll < a) {
        $('.menu').removeClass('active');
    }
});

$(window).load(function() {
    // Add sticky header on load
    var a = $(".hero-image").offset().top + $(".hero-image").height();
    var scroll = $(window).scrollTop();
    if (scroll > a) {
        $('.menu').addClass('active');
    } else if (scroll < a) {
        $('.menu').removeClass('active');
    }
});