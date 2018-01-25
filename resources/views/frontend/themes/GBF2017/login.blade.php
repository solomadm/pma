@php
    $page_settings = [
        'display_banner' => false,
        'body_class' => 'form',
        'header_image_override' => $login['header_image_override'],
        'header_register_button' => true
    ];
@endphp

@extends('frontend.themes.GBF2017.layouts.app')

@section('meta_title'){{$login['meta_title'] or $global['meta_title']}} | {{$global['meta_title']}}@endsection

@section('meta_description'){{$login['meta_description'] or $global['meta_description']}}@endsection

@section('content')

    <div id="app">

        <div class="page-heading container-padding">
            <ol class="breadcrumb">
                <li><a href="{{General::conferenceRoute('frontend.index')}}">home</a></li>
                <li class="active"><a class="active-breadcrumb" href="#">login</a></li>
            </ol>
            <h1>{{$login['page_heading']}}</h1>
            @if($login['page_subheading'] != "")
                <hr/>
                {!! $login['page_subheading'] !!}
            @endif
        </div>

        <login-form :ajax-path="'{{General::conferenceRoute('frontend.login.post')}}'"></login-form>

    </div>

@endsection
