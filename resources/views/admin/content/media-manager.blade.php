@extends('admin.layouts.app')

@section('page_title')
    Media Manager
@endsection

@section('main-content')

    <media-manager :asset-list="{{ Auth::user()->conference->assets->groupBy('type')->toJson() }}"></media-manager>

@endsection
