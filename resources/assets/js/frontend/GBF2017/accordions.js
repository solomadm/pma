// FAQ Expand all accordions button
$(function () {
    var active = true;

    $('.expandAll').click(function () {
        if (active) {
            active = false;
            $('.panel-collapse').collapse('show');
            $('.panel-collapse').css('height','');
            $('.panel-collapse').addClass('in');
            $('.panel-title').attr('data-toggle', '');
            $('.panel-title span').removeClass('glyphicon-menu-down');
            $('.panel-title span').addClass('glyphicon-menu-up');
            $(this).text('Collapse All');
        } else {
            active = true;
            $('.panel-collapse').collapse('hide');
            $('.panel-title').attr('data-toggle', 'collapse');
            $(this).text('Expand All');
        }
    });
    $('.expandAll1').click(function () {
        if (active) {
            active = false;
            $('#day1 .panel-collapse').collapse('show');
            $('#day1 .panel-collapse').css('height','');
            $('#day1 .panel-collapse').addClass('in');
            $('#day1 .panel-title').attr('data-toggle', '');
            $('#day1 .panel-title span').removeClass('glyphicon-menu-down');
            $('#day1 .panel-title span').addClass('glyphicon-menu-up');
            $(this).text('Collapse All');
        } else {
            active = true;
            $('#day1 .panel-collapse').collapse('hide');
            $('#day1 .panel-title').attr('data-toggle', 'collapse');
            $(this).text('Expand All');
        }
    });
    $('.expandAll2').click(function () {
        if (active) {
            active = false;
            $('#africalive .panel-collapse').collapse('show');
            $('#africalive .panel-collapse').css('height','');
            $('#africalive .panel-collapse').addClass('in');
            $('#africalive .panel-title').attr('data-toggle', '');
            $('#africalive .panel-title span').removeClass('glyphicon-menu-down');
            $('#africalive .panel-title span').addClass('glyphicon-menu-up');
            $(this).text('Collapse All');
        } else {
            active = true;
            $('#africalive .panel-collapse').collapse('hide');
            $('#africalive .panel-title').attr('data-toggle', 'collapse');
            $(this).text('Expand All');
        }
    });
    $('.expandAll3').click(function () {
        if (active) {
            active = false;
            $('#day2 .panel-collapse').collapse('show');
            $('#day2 .panel-collapse').css('height','');
            $('#day2 .panel-collapse').addClass('in');
            $('#day2 .panel-title').attr('data-toggle', '');
            $('#day2 .panel-title span').removeClass('glyphicon-menu-down');
            $('#day2 .panel-title span').addClass('glyphicon-menu-up');
            $(this).text('Collapse All');
        } else {
            active = true;
            $('#day2 .panel-collapse').collapse('hide');
            $('#day2 .panel-title').attr('data-toggle', 'collapse');
            $(this).text('Expand All');
        }
    });
});

// Change accordion arrows on click
$('.collapse').on('shown.bs.collapse', function(){
    $(this).parent().find(".glyphicon-menu-down").removeClass("glyphicon-menu-down").addClass("glyphicon-menu-up");
}).on('hidden.bs.collapse', function(){
    $(this).parent().find(".glyphicon-menu-up").removeClass("glyphicon-menu-up").addClass("glyphicon-menu-down");
});

// Read more/Read less button
$(".read-btn").click(function() {
    var more='Read more <span class="glyphicon glyphicon-menu-down">';
    var less='Read Less <span class="glyphicon glyphicon-menu-up">';

    if ($(this).hasClass("more")) {
        $(this).html(less)
        $(this).removeClass("more")
        $(this).addClass('less')
    } else if ($(this).hasClass("less")) {
        $(this).html(more)
        $(this).removeClass("less")
        $(this).addClass('more')
    }
});

// Breadcrumbs active class on the tab currently active
var activeBreadcrumb = $('.active-breadcrumb');

$('.nav.nav-tabs').on('click','.tab-link',function(){
    var self = $(this);
    activeBreadcrumb.attr('href',self.data('url'));
    activeBreadcrumb.text(self.text());
});

// Locate to different tabs on one page
$(document).ready(function() {
    var hash = document.location.hash;
    if (hash) {
        console.log(hash);
        $('.nav-tabs a[href="'+hash+'"]').tab('show');
    }
    //if (hash != '') {
    //    location.hash = '';
    //    history.pushState('', document.title, window.location.pathname);
    //}
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        e.preventDefault();
        window.location.hash = e.target.hash.replace("#", "#");
        return false;
    });
});

// Back to top on africa live anchor tag
$(".back-to-africalive").click(function(){
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return true;
});

$(window).on('hashchange',function() {
    var hash = document.location.hash;
    if (hash) {
        console.log(hash);
        $('.nav-tabs a[href="'+hash+'"]').tab('show');
    }
    //if (hash != '') {
    //    location.hash = '';
    //    history.pushState('', document.title, window.location.pathname);
    //}
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        e.preventDefault();
        window.location.hash = e.target.hash.replace("#", "#");
        return false;
    });
});

// Collapse bootstrap panels when clicking on anchor tag
//$(document).ready(function () {
//    location.hash && $(location.hash + '.collapse').collapse('show');
//});