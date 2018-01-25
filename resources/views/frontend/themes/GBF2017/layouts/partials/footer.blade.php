<footer class="container-padding" style="background-image: url('{{App\Content::AssetPath($global['footer_background_image'])}}');">
    <div class="footer-inner">
        <a href="#" class="scrollToTop" ><img src="images/common/scroll-top.png" alt="" /></a>
        <!--<div class="col-xs-12 visible-xs">-->
        <!--<h3>Get our official app on <span>your smartphone</span></h3>-->
        <!--<a href=""><img src="images/common/app_store.png" alt="" class="store" /></a>-->
        <!--<a href=""><img src="images/common/play_store.png" alt="" class="store" /></a>-->
        <!--</div>-->
        <!--<div class="col-sm-4 col-sm-push-4">-->
        <!--<div class="col-md-6 organised_by">-->
        <div class="col-lg-4 col-md-4 organised_by">
            <!--<div class="col-sm-4 col-sm-pull-4 organised_by">-->
            <div class="links-inner">
                <h3>{{$global['footer_left_text']}}</h3>
                <a href="{{$global['footer_left_link']}}" target="_blank"><img src="{{App\Content::AssetPath($global['footer_left_image'])}}" alt="" class="img-responsive"/></a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 social-icons">
            <div class="social-inner">
                <h3>{{$global['footer_social_text']}}</h3>
                <ul>
                    <li><a class="facebook" href="{{$global['footer_social_link_fb']}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="twitter" href="{{$global['footer_social_link_tw']}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="linkedin" href="{{$global['footer_social_link_ln']}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    <li><a class="youtube" href="{{$global['footer_social_link_yt']}}" target="_blank"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 association">
            <!--<div class="col-sm-4 col-sm-pull-4 organised_by">-->
            <div class="links-inner">
                <h3>{{$global['footer_right_text']}}</h3>
                <a href="{{$global['footer_right_link']}}" target="_blank"><img src="{{App\Content::AssetPath($global['footer_right_image'])}}" alt=""
                                                                                           class="img-responsive"/></a>
            </div>
        </div>
        <!--<div class="col-sm-4 hidden-xs">-->
        <!--<h3>Get our official app on <span>your smartphone</span></h3>-->
        <!--<a href=""><img src="images/common/app_store.png" alt="" class="store" /></a>-->
        <!--<a href=""><img src="images/common/play_store.png" alt="" class="store" /></a>-->
        <!--</div>-->
    </div>
</footer>
<div class="copyright container-padding">
    <div class="col-md-8 copyright-menu">
        <ul class="nav navbar-nav">
            <li>
                <a href="index.html">home</a>
                <a href="about.html">about</a>
                <a href="programme.html">programme</a>
                <a href="speakers-landing.html">speakers</a>
                <a href="sponsors-landing.html">sponsors & partners</a>
                <a href="travel-venue.html">travel & venue</a>
                <a href="faq.html">faq</a>
                <a href="knowledge-hub.html">knowledge hub</a>
                <a href="media.html">media</a>
                <a href="contact.html">contact</a>
            </li>
        </ul>
    </div>
    <div class="col-md-4 copyright-mark">
        <p>{{$global['footer_copyright_text']}}</p>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js" type="text/javascript"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<script src="/frontend/js/modules.js" type="text/javascript"></script>
<script src="/frontend/js/app.js" type="text/javascript"></script>

<script>
    flexibility(document.body);
</script>

<script>
    var b = document.documentElement;
    b.setAttribute('data-useragent',  navigator.userAgent);

    $(document).on('ready', function() {

        $('.slider-section').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 6,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
        $('.gallery-section').slick({
            slidesToShow:1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.gallery-section',
            arrows: true,
            focusOnSelect: true
        });
    });

    $(function () {
        $(document).on('shown.bs.tab', 'a[data-toggle=\'tab\']', function (e) {
            $('.sp-expanded-tab').readmore({
                speed: 75,
                collapsedHeight:0
            });
        })
    });
</script>
