@php
    $page_settings = [
        'display_banner' => false,
        'body_class' => 'form',
        'header_image_override' => $register['header_image_override'],
        'header_register_button' => true
    ];
@endphp

@extends('frontend.themes.GBF2017.layouts.app')

@section('meta_title'){{$register['meta_title'] or $global['meta_title']}} | {{$global['meta_title']}}@endsection

@section('meta_description'){{$register['meta_description'] or $global['meta_description']}}@endsection

@section('content')

    <div id="app">

        <div class="page-heading container-padding">
            <ol class="breadcrumb">
                <li><a href="{{General::conferenceRoute('frontend.index')}}">home</a></li>
                <li class="active"><a class="active-breadcrumb" href="#">registration</a></li>
            </ol>
            <h1>{{$register['page_heading']}}</h1>
            @if($register['page_subheading'] != "")
                <hr/>
                {!! $register['page_subheading'] !!}
            @endif
        </div>

        <register-form :register-url="'{{General::conferenceRoute('frontend.register.post')}}'"></register-form>

    </div>

@endsection
