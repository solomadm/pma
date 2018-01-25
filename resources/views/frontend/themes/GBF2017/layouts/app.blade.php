<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('meta_title')</title>

    <meta name="description" content="@yield('meta_description')">

    @include('frontend.themes.GBF2017.layouts.partials.head')

</head>
<body class="{{$page_settings['body_class'] or ''}}">

@include('frontend.themes.GBF2017.layouts.partials.header')

<div>
    @yield('content')
</div>

@include('frontend.themes.GBF2017.layouts.partials.footer')

</body>
</html>
