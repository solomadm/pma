@php
    $page_settings = [
        'display_banner' => false,
        'body_class' => 'tabs',
        'header_image_override' => $speakers['header_image_override'],
        'header_register_button' => true
    ];
@endphp

@extends('frontend.themes.GBF2017.layouts.app')

@section('meta_title'){{$profile['name'] or $global['meta_title']}} | {{$global['meta_title']}}@endsection

@section('meta_description'){{str_limit(strip_tags($profile['bio']), 157, '...')}}@endsection

@section('content')

    <div class="page-heading container-padding page-heading-less">
        <ol class="breadcrumb">
            <li><a href="{{General::conferenceRoute('frontend.index')}}">home</a></li>
            <li><a href="{{General::conferenceRoute('frontend.speakers')}}">speakers</a></li>
            <li class="active"><a class="active-breadcrumb" href="#">{{$profile['name']}}</a></li>
        </ol>
        <div class="individual-speaker">
            <div class="col-md-4">
                <img src="{{App\Content::AssetPath($profile['photo'])}}" class="img-responsive" alt=""/>
                <div class="grey-block">
                    <h3>speaker programme</h3>
                    <div class="grey-block-inner">
                        <p>Wednesday, 1 November 2017 <span>09:00 - 09:10</span> <a href="programme.html#collapseDayOneTabTwo">WELCOME ADDRESS</a></p>
                    </div>
                    <a href="programme.html##day1" class="link">view full programme</a>
                </div>
            </div>
            <div class="col-md-8 speaker-profile-info">
                <h2>speaker profile</h2>
                <h1>{{$profile['name']}}</h1>
                <span class="title">{{$profile['company_title']}}, {{$profile['company']}}<span class="country">{{$profile['country']}}</span></span>
                {!! $profile['bio'] !!}
                <br><br>
                <a href="{{General::conferenceRoute('frontend.speakers')}}"><i class="glyphicon glyphicon-menu-left"></i> <span>back to speakers</span></a>
            </div>
        </div>
    </div>

    <div class="main-copy container-padding">
        <h3 class="speakers">{{$speakers['confirmed_heading']}}</h3>
        <section class="slider-section">
            @foreach($speakerList['1'] as $s)
                <div class="col-md-2">
                    <a href="{{General::conferenceRoute('frontend.speakers.profile', $s['id'])}}">
                        <img src="{{App\Content::AssetPath($s['photo'])}}" class="img-responsive">
                    </a>
                </div>
            @endforeach
        </section>

    </div>

@endsection
