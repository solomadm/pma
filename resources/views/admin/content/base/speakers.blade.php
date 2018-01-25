@extends('admin.layouts.app')

@section('page_title')
    Conference Speakers Page
@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <content-base-speakers :content="{{$content}}"
                                       :asset-images="{{GeneralHelper::ImageCollectionToSelect2(Auth::user()->conference->assets->where('type','images'))}}"></content-base-speakers>

            </div>
        </div>
    </div>
@endsection
