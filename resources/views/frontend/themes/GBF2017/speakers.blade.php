@php
    $page_settings = [
        'display_banner' => false,
        'body_class' => 'tabs',
        'header_image_override' => $speakers['header_image_override'],
        'header_register_button' => true
    ];
@endphp

@extends('frontend.themes.GBF2017.layouts.app')

@section('meta_title'){{$speakers['meta_title'] or $global['meta_title']}} | {{$global['meta_title']}}@endsection

@section('meta_description'){{$speakers['meta_description'] or $global['meta_description']}}@endsection

@section('content')

    <div class="page-heading container-padding page-heading-less">
        <ol class="breadcrumb">
            <li><a href="{{General::conferenceRoute('frontend.index')}}">home</a></li>
            <li><a href="{{General::conferenceRoute('frontend.speakers')}}">speakers</a></li>
            <li class="active"><a class="active-breadcrumb" href="#">confirmed speakers</a></li>
        </ol>
        <h1>{{$speakers['page_heading']}}</h1>
        @if($speakers['page_subheading'] != "")
            <hr/>
            {!! $speakers['page_subheading'] !!}
        @endif
    </div>

    <div class="tabs-copy">
        <div id="speakers-tab">
            <ul class="nav nav-tabs container">
                <li class="active">
                    <a href="##confirmed-speakers" class="tab-link" data-toggle="tab">{{$speakers['confirmed_heading']}}</a>
                </li>
                <li>
                    <a href="##previous-speakers" class="tab-link" data-toggle="tab">{{$speakers['previous_heading']}}</a>
                </li>
            </ul>
            <div class="tab-content container-padding">
                <div class="tab-pane active" id="confirmed-speakers">
                    {!! $speakers['confirmed_text'] !!}
                    <div class="speaker-profile-container">
                        @foreach($speakerList['1'] as $s)
                            <div class="col-md-3 col-sm-6 speaker-profile center-block">
                                <a href="{{General::conferenceRoute('frontend.speakers.profile', $s['id'])}}" class="speaker-profile-data">
                                    <img src="{{App\Content::AssetPath($s['photo'])}}" alt="" class="img-responsive"/>
                                    <div class="profile-block">
                                        <h3>{{$s['name']}}</h3>
                                        <p>{{$s['company_title']}}, {{$s['company']}}</p>
                                        <p>{{$s['country']}}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane" id="previous-speakers">
                    {!! $speakers['previous_text'] !!}
                    <div class="speaker-profile-container">

                        @foreach($speakerList['2'] as $s)
                            <div class="col-md-3 col-sm-6 speaker-profile center-block">
                                <a href="{{General::conferenceRoute('frontend.speakers.profile', $s['id'])}}" class="speaker-profile-data">
                                    <img src="{{App\Content::AssetPath($s['photo'])}}" alt="" class="img-responsive"/>
                                    <div class="profile-block">
                                        <h3>{{$s['name']}}</h3>
                                        <p>{{$s['company_title']}}</p>
                                        <p>{{$s['country']}}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
