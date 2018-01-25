@extends('admin.layouts.app')

@section('page_title')
    Conference Registration Page
@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <content-base-register :content="{{$content}}"
                                       :asset-images="{{GeneralHelper::ImageCollectionToSelect2(Auth::user()->conference->assets->where('type','images'))}}"></content-base-register>

            </div>
        </div>
    </div>
@endsection
