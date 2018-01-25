<div class="mobile-first">
    <div class="mainContainer">
        <header class="menu">
            <div class="navbar-section">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{General::conferenceRoute('frontend.index')}}">
                        <img src="{{App\Content::AssetPath($global['event_logo'])}}" alt="" class="img-responsive">
                    </a>
                    <a href="#" class="menuBtn">
                        <span class="lines"></span>
                    </a>
                </div>
            </div>
            <nav class="mainMenu navbar navbar-default">
                <ul class="nav navbar-nav nav-sub pull-right">
                    <hr class="visible-xs"/>
                    <li><a href="{{General::conferenceRoute('frontend.contact')}}">contact</a></li>
                    @if(Auth::guard( 'delegate' )->check())
                        <li>
                            <a href="{{General::conferenceRoute('frontend.logout')}}">
                                Hi, {{Auth::guard( 'delegate' )->user()->first_name}}. Logout
                            </a>
                        </li>
                    @else
                        <li><a href="{{General::conferenceRoute('frontend.register')}}">register</a></li>
                        <li><a href="{{General::conferenceRoute('frontend.login')}}">login</a></li>
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{General::conferenceRoute('frontend.index')}}" class="visible-xs current">home</a></li>
                    <li class="dropdown">
                        <a href="about.html" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">about</a>
                        <ul class="dropdown-menu">
                            <li><a href="about.html#aboutTab1">about gbf africa</a></li>
                            <li><a href="about.html#aboutTab2">who should attend?</a></li>
                            <li><a href="about.html#aboutTab3">why attend?</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{General::conferenceRoute('frontend.programme')}}" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">programme</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{General::conferenceRoute('frontend.programme')}}##day1">day 1</a></li>
                        </ul>
                    </li>
                    <li><a href="{{General::conferenceRoute('frontend.speakers')}}">speakers</a></li>
                    <li><a href="sponsors-partners.html">sponsors & partners</a></li>
                    <li><a href="travel-venue.html">travel & venue</a></li>
                    <li><a href="faq.html">faq</a></li>
                    <li><a href="knowledge-hub.html">knowledge hub</a></li>
                    <li><a href="media.html">media</a></li>
                </ul>
            </nav>
            @if($page_settings['display_banner'] == true)
                <div class="burgundy burgundy-hidden">
                    <div class="empty-space"></div>
                    <div class="text-center">
                        {!! $global['header_banner'] !!}
                    </div>
                </div>
            @endif
        </header>
    </div>

    @if($page_settings['header_register_button'])
        <div class="container-fluid other-intro">
            <div class="row">
                <div class="intro-left hidden-xs">
                    <a href="{{General::conferenceRoute('frontend.register')}}" class="btn btn-default">register now</a>
                </div>
                <div class="intro-right">
                    <h3>{{$global['forum_date']}} <span>{{$global['forum_venue']}}</span></h3>
                </div>
                <div class="intro-left visible-xs">
                    <a href="{{General::conferenceRoute('frontend.register')}}" class="btn btn-default">register now</a>
                </div>
            </div>
        </div>
    @else
        <div class="container-fluid home-intro">
            <div class="row">
                <div class="intro-left intro-home">
                    <h3>{{$global['forum_date']}} <span>{{$global['forum_venue']}}</span></h3>
                </div>
                <div class="intro-right intro-home">
                    <h1>{!! $global['forum_title'] !!}</h1>
                </div>
            </div>
        </div>
    @endif

</div>
