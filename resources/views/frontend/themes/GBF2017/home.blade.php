@php
    $page_settings = [
        'display_banner' => true,
        'body_class' => 'home',
        'header_image_override' => false,
        'header_register_button' => false
    ];
@endphp

@extends('frontend.themes.GBF2017.layouts.app')

@section('meta_title'){{$home['meta_title']}} | {{$global['meta_title']}}@endsection

@section('meta_description'){{$home['meta_description'] or $global['meta_description']}}@endsection

@section('content')

    @if($home['countdown_enabled'] == true)
        <div class="countdown-section" style="background-image:url('{{App\Content::AssetPath($home['countdown_background'])}}');">
        <div class="timer-section container-padding">
            <div class="heading-block">
                <!--<h3>1-2 november 2017</h3>-->
                <h2>{!!$home['countdown_heading']!!}</h2>
            </div>
            <div id="countdown">
                <div class="cd-box">
                    <p class="numbers days">00</p>
                    <p class="strings timeRefDays">Days</p>
                </div>
                <div class="cd-box">
                    <p class="numbers hours">00</p>
                    <p class="strings timeRefHours">Hours</p>
                </div>
                <div class="cd-box">
                    <p class="numbers minutes">00</p>
                    <p class="strings timeRefMinutes">Minutes</p>
                </div>
                <div class="cd-box">
                    <p class="numbers seconds">00</p>
                    <p class="strings timeRefSeconds">Seconds</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            $("#countdown").countdown({
                date: "{{GeneralHelper::countdownDateFromString($home['countdown_date'])}} {{$home['countdown_time']}}:00",
                format: "on"
            });
        });
    </script>
    @endif

    @if($home['numbers_enabled'] == true)
        <div class="gbf-africa-section container-padding" style="background-image: url('{{App\Content::AssetPath($home['numbers_background'])}}');">
            <h2>{!! $home['numbers_heading'] !!}</h2>
        <div class="chart-circle">
            <img src="images/home/circle-1.png" alt="" class="img-responsive center-block ie-gbf" />
            <span class="chart chart1" data-percent="{{$home['numbers_figure_1_percent']}}">
                <span class="percent">{{$home['numbers_figure_1_value']}}</span>
            </span>
            <h3>{{$home['numbers_figure_1_heading']}}</h3>
        </div>
        <div class="chart-circle">
            <img src="images/home/circle-2.png" alt="" class="img-responsive center-block ie-gbf" />
            <span class="chart chart2" data-percent="{{$home['numbers_figure_2_percent']}}">
                <span class="percent">{{$home['numbers_figure_2_value']}}</span>
            </span>
            <h3>{{$home['numbers_figure_2_heading']}}</h3>
        </div>
        <div class="chart-circle">
            <img src="images/home/circle-3.png" alt="" class="img-responsive center-block ie-gbf" />
            <span class="chart chart3" data-percent="{{$home['numbers_figure_3_percent']}}">
                <span class="percent">{{$home['numbers_figure_3_value']}}</span>
            </span>
            <h3>{{$home['numbers_figure_3_heading']}}</h3>
        </div>
        <div class="chart-circle">
            <img src="images/home/circle-4.png" alt="" class="img-responsive center-block ie-gbf" />
            <span class="chart chart4" data-percent="{{$home['numbers_figure_4_percent']}}">
                <span class="percent">{{$home['numbers_figure_4_value']}}</span>
            </span>
            <h3>{{$home['numbers_figure_4_heading']}}</h3>
        </div>
        <div class="chart-circle">
            <img src="images/home/circle-5.png" alt="" class="img-responsive center-block ie-gbf" />
            <span class="chart chart5" data-percent="{{$home['numbers_figure_5_percent']}}">
                <span class="percent">{{$home['numbers_figure_5_value']}}</span>
            </span>
            <h3>{{$home['numbers_figure_5_heading']}}</h3>
        </div>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            $('.chart').easyPieChart({
                easing: 'easeOutBounce',
                animate: false,
                scaleColor: false,
                barColor: '#FFFFFF',
                trackColor: '#a8e800',
                size: '200',
                lineWidth: '4'
            });
        });
    </script>
    @endif

    @if($home['speakers_enabled'] == true)
    <div class="speakers-section main-copy container-padding">
        <div class="col-lg-6 col-md-12 speakers-text">
            <h2 class="section-heading">{{$home['speakers_heading']}}</h2>
            <p>{!! $home['speakers_copy'] !!}</p>
            <a href="{{$home['speakers_button_link']}}" class="btn btn-default hidden-xs">{{$home['speakers_button_copy']}}</a>
        </div>
        <div class="col-lg-6 col-md-12 speakers-block">

            @foreach($featured_speakers as $s)
            <div class="col-md-6 speaker-container">
                <a href="#">
                    <div class="speaker-inner">
                        <img src="{{App\Content::AssetPath($s['photo'])}}" class="img-responsive" alt=""/>
                        <div class="speaker-overlay">
                            <div class="speaker-overlay-inner-wrapper">
                                <div class="speaker-overlay-inner">
                                    <h4>{{$s['name']}}</h4>
                                    <p>{{$s['company_title']}} <span>{{$s['company']}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
        <a href="{{$home['speakers_button_link']}}" class="btn btn-default visible-xs">{{$home['speakers_button_copy']}}</a>
    </div>
    @endif

    @if($home['programme_enabled'] == true)
    <div class="programme-section container-padding">
        <div class="col-lg-6 col-md-12 programme-block programme-inner">
            <h3>{!!$home['programme_copy_2']!!}</h3>
        </div>
        <div class="col-lg-6 col-md-12 programme-text programme-inner">
            <h2 class="section-heading">{{$home['programme_heading']}}</h2>
            <p>{!!$home['programme_copy']!!}</p>
            <a href="programme.html##day1" class="btn btn-default">find out more</a>
        </div>
    </div>
    @endif

    @if($home['push_enabled'] == true)
        <div class="programme-knowledgeHub-section container-padding" style="background-image: url('{{App\Content::AssetPath($home['push_background'])}}');">
            <h3>{{$home['push_heading']}}</h3>
        <div class="col-lg-6 col-md-6 col-sm-6 programme-block">
            <a href="{{$home['push_left_link_link']}}">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="{{App\Content::AssetPath($home['push_left_image'])}}" alt=""/>
                    </div>
                    <div class="panel-body">
                        <h3>{{$home['push_left_heading']}}</h3>
                        <p>{!! $home['push_left_copy'] !!}</p>
                    </div>
                    <p><span>{{$home['push_left_link_copy']}}</span></p>
                    <div class="panel-footer">
                        <span>
                            <img src="/frontend/img/GBF2017/panel_arrow.png" alt=""/>
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 knowledgeHub-block">
            <a href="{{$home['push_left_link_link']}}">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="{{App\Content::AssetPath($home['push_right_image'])}}" alt=""/>
                    </div>
                    <div class="panel-body">
                        <h3>{{$home['push_right_heading']}}</h3>
                        <p>{!! $home['push_right_copy'] !!}</p>
                    </div>
                    <p><span>{{$home['push_right_link_copy']}}</span></p>
                    <div class="panel-footer">
                        <span>
                            <img src="/frontend/img/GBF2017/panel_arrow.png" alt=""/>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endif
@endsection
