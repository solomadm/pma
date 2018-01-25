@php
    $page_settings = [
        'display_banner' => false,
        'body_class' => 'form',
        'header_image_override' => isset($contact['header_image_override'])?$contact['header_image_override']:false,
        'header_register_button' => true
    ];
@endphp

@extends('frontend.themes.GBF2017.layouts.app')

@section('meta_title'){{$contact['name'] or $global['meta_title']}} | {{$global['meta_title']}}@endsection

{{--@section('meta_description'){{str_limit(strip_tags($contact['bio']), 157, '...')}}@endsection--}}

@section('content')

    <div id="app">

        <div class="page-heading container-padding">
            <ol class="breadcrumb">
                <li><a href="{{General::conferenceRoute('frontend.index')}}">home</a></li>
                <li class="active"><a class="active-breadcrumb" href="#">contact</a></li>
            </ol>
            <h1>{{$contact['page_heading'] or 'Contact Us'}}</h1>
            <hr/>
            <p>{{ isset($contact['page_subheading']) ? $contact['page_subheading'] : 'All fields marked with * are mandatory.' }}</p>
        </div>

        <contact-form :counties="{{json_encode($countries)}}"></contact-form>

    </div>

@endsection
