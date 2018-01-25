@php
    $page_settings = [
        'display_banner' => false,
        'body_class' => 'tabs',
        'header_image_override' => $programme['header_image_override'],
        'header_register_button' => true
    ];
@endphp

@extends('frontend.themes.GBF2017.layouts.app')

@section('meta_title'){{$programme['meta_title'] or $global['meta_title']}} | {{$global['meta_title']}}@endsection

@section('meta_description'){{$programme['meta_description'] or $global['meta_description']}}@endsection

@section('content')

    <div class="page-heading container-padding page-heading-less">
        <ol class="breadcrumb">
            <li><a href="{{General::conferenceRoute('frontend.index')}}">home</a></li>
            <li><a href="{{General::conferenceRoute('frontend.programme')}}">programme</a></li>
            <li class="active"><a class="active-breadcrumb" href="#">day 1</a></li>
        </ol>
        <h1>{{$programme['page_heading']}}</h1>
        @if($programme['page_subheading'] != "")
            <hr/>
            {!! $programme['page_subheading'] !!}
        @endif

        <div class="search-box container center-block">
            <div class="filtering-container">
                <div class="col-md-2 filtering">
                    <p>search:</p>
                </div>
                <div class="col-md-10">
                    <div class="col-md-4 col-sm-12 filtering">
                        <select class="selectpicker" id="industryFilter2" name="industry_filter" title="Industry" data-width="100%" required>
                            <option value="" selected>Industry</option>
                            <option value="Agriculture">Agriculture</option>
                            <option value="Association/ Think Tank/ Charity">Association/ Think Tank/ Charity</option>
                            <option value="Conglomerate">Conglomerate</option>
                            <option value="Construction/ engineering">Construction/ engineering</option>
                            <option value="Consumer Goods">Consumer Goods</option>
                            <option value="Embassy/ Chamber">Embassy/ Chamber</option>
                            <option value="Fund Management">Fund Management</option>
                            <option value="Government">Government</option>
                            <option value="Health/ Pharmaceutical">Health/ Pharmaceutical</option>
                            <option value="ICT">ICT</option>
                            <option value="Insurance">Insurance</option>
                            <option value="Investment Banking">Investment Banking</option>
                            <option value="Investment Promotion Agency">Investment Promotion Agency</option>
                            <option value="Legal services">Legal services</option>
                            <option value="Manufacturing">Manufacturing</option>
                            <option value="Marketing/ PR/ communications">Marketing/ PR/ communications</option>
                            <option value="Mining">Mining</option>
                            <option value="Other">Other</option>
                            <option value="Publishing">Publishing</option>
                            <option value="Real Estate">Real Estate</option>
                            <option value="Retail">Retail</option>
                            <option value="Retail Banking">Retail Banking</option>
                            <option value="Science and Technology">Science and Technology</option>
                            <option value="Services">Services</option>
                            <option value="Sovereign Wealth Fund">Sovereign Wealth Fund</option>
                            <option value="Tourism">Tourism</option>
                            <option value="Transport/ Logistics/ Infrastructure">Transport/ Logistics/ Infrastructure</option>
                            <option value="Travel/ Hospitality/ Entertainment">Travel/ Hospitality/ Entertainment</option>
                            <option value="Water and Sanitation">Water and Sanitation</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12 filtering">
                        <select class="selectpicker" id="pillars1" name="pillars_filter" title="Pillars" data-width="100%" required>
                            <option value="" selected>Pillars</option>
                            <option value="Future Realities">Future Realities</option>
                            <option value="Next Generation Solutions">Next Generation Solutions</option>
                            <option value="Game Changers">Game Changers</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12 filtering">
                        <select class="selectpicker" id="speakersFilter1" name="speakers_filter" title="Speakers" data-width="100%" required>
                            <option value="" selected>Speakers</option>
                            <option value="H.E. Paul Kagame">H.E. Paul Kagame</option>
                            <option value="H.E. Majid Saif Al Ghurair">H.E. Majid Saif Al Ghurair</option>
                            <option value="Andrew Alli">Andrew Alli</option>
                            <option value="Arif Amiri">Arif Amiri</option>
                            <option value="Goolam Ballim">Goolam Ballim</option>
                            <option value="Hakeem Belo-Osagie">Hakeem Belo-Osagie</option>
                            <option value="Tonye Cole">Tonye Cole</option>
                            <option value="John Defterios">John Defterios</option>
                            <option value="Sangu Delle">Sangu Delle</option>
                            <option value="Bob Diamond">Bob Diamond</option>
                            <option value="Mark Eddo">Mark Eddo</option>
                            <option value="Reda El Chaar">Reda El Chaar</option>
                            <option value="Hikmet Ersek">Hikmet Ersek</option>
                            <option value="Chris Folayan">Chris Folayan</option>
                            <option value="H.E. Ameenah Gurib-Fakim">H.E. Ameenah Gurib-Fakim</option>
                            <option value="Gbubemi Fregene">Gbubemi Fregene</option>
                            <option value="Rob Hersov">Rob Hersov</option>
                            <option value="Jeremy Hodara">Jeremy Hodara</option>
                            <option value="Aboyeji Iyinoluwa">Aboyeji Iyinoluwa</option>
                            <option value="Amy Jadesimi">Amy Jadesimi</option>
                            <option value="Rebecca McLaughlin-Duane">Rebecca McLaughlin-Duane</option>
                            <option value="Vahid Monadjem">Vahid Monadjem</option>
                            <option value="Louis Antoine Muhire">Louis Antoine Muhire</option>
                            <option value="Naga Munchetty">Naga Munchetty</option>
                            <option value="Shayne Nelson">Shayne Nelson</option>
                            <option value="Tony Nyagah">Tony Nyagah</option>
                            <option value="Eghosa Omoigui">Eghosa Omoigui</option>
                            <option value="Ada Osakwe">Ada Osakwe</option>
                            <option value="Tayo Oviosu">Tayo Oviosu</option>
                            <option value="Taavi Roivas">Taavi Roivas</option>
                            <option value="Ashish Thakkar">Ashish Thakkar</option>
                            <option value="Eithne Treanor">Eithne Treanor</option>
                            <option value="Feleg Tsegaye">Feleg Tsegaye</option>
                            <option value="Gary Urteaga">Gary Urteaga</option>
                            <option value="Affiong Williams">Affiong Williams</option>
                            <option value="Lai Yahaya">Lai Yahaya</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="tabs-copy">
        <div id="programme-tab">
            <ul class="nav nav-tabs container">
                <li class="active">
                    <a href="##day1" class="tab-link" data-toggle="tab">Day 1</a>
                </li>
            </ul>
            <div class="tab-content container-padding">
                <div class="tab-pane active" id="confirmed-speakers">

                </div>
            </div>
        </div>
    </div>

@endsection
