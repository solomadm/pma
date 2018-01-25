<div class="hero-image" style="background-image: url('{{App\Content::AssetPath($global['header_image'])}}')">

    @include('frontend.themes.GBF2017.layouts.partials.nav')

    @if($page_settings['header_image_override'])
        <img src="{{App\Content::AssetPath($page_settings['header_image_override'])}}" class="hidden-xs hero-image"/>
    @else
        <img src="{{App\Content::AssetPath($global['header_image'])}}" class="hidden-xs hero-image"/>
    @endif
</div>

@if($page_settings['display_banner'] == true)
<div class="burgundy-home">
    {!! $global['header_banner'] !!}</span>
</div>
@endif
