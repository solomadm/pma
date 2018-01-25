@extends('admin.layouts.app')

@section('page_title')
    Global Conference Content
@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <content-global :content="{{$content}}" :asset-images="{{App\Helpers\General::ImageCollectionToSelect2(Auth::user()->conference->assets->where('type','images'))}}"></content-global>

            </div>
        </div>
    </div>
@endsection
