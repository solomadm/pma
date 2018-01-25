@php
    $page_settings = [
        'display_banner' => false,
        'body_class' => 'form',
        'header_image_override' => isset($media['header_image_override'])?$media['header_image_override']:false,
        'header_register_button' => true
    ];
@endphp

@extends('frontend.themes.GBF2017.layouts.app')

@section('meta_title'){{$media['name'] or $global['meta_title']}} | {{$global['meta_title']}}@endsection

{{--@section('meta_description'){{str_limit(strip_tags($media['bio']), 157, '...')}}@endsection--}}

@section('content')

    <div id="app">

        <div class="page-heading container-padding">
            <ol class="breadcrumb">
                <li><a href="{{General::conferenceRoute('frontend.index')}}">home</a></li>
                <li class="active"><a class="active-breadcrumb" href="#">media registration</a></li>
            </ol>
            <h1>{{$media['page_heading'] or 'media registration'}}</h1>
            <hr/>
            <p>
                @if(isset($media['page_subheading']))
                    {{$media['page_subheading']}}
                @else
                    Media attendance at the Forum is by accreditation only. Please complete the application form if you
                    wish to attend as media. All fields marked with <sup>*</sup> are mandatory.
                @endif
            </p>
        </div>

        <media-register-form :countries="{{json_encode($countries)}}"></media-register-form>

    </div>

    <div id="film-photography-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">NOTICE OF FILMING AND PHOTOGRAPHY</h4>
                </div>
                <div class="modal-body">
                    <p>Please be advised that photos, video and audio footage will be taken at this event. By entering
                        the event premises, you give consent to Dubai Chamber to photograph and video record your
                        presence at the event, and its subsequent release, publication, exhibition, or reproduction to
                        be used for news, promotional purposes, advertising, inclusion on websites, social media, or any
                        other purpose by Dubai Chamber and its partners.</p>
                    <p>You release Dubai Chamber, its employees, and every person involved from any liability connected
                        with the taking, recording, digitizing, or publication and use of interviews, photographs, video
                        and audio recordings. By entering the event premises, you waive all rights you may have to any
                        claims for payment or royalties in connection with any use, exhibition, streaming, web-casting,
                        televising, or other publication of these materials.</p>
                    <p>You also waive any right to inspect or approve any photo, video, or audio recording taken by
                        Dubai Chamber or the person or entity designated to do so by Dubai Chamber.</p>
                    <p>By checking this box, You acknowledge that you have been fully informed of your consent, waiver
                        of liability, and release before entering the event.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
