@extends('admin.layouts.app')

@section('page_title')
    Conference Home page
@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <content-base-home :content="{{$content}}"
                                   :asset-images="{{App\Helpers\General::ImageCollectionToSelect2(Auth::user()->conference->assets->where('type','images'))}}"></content-base-home>

            </div>
        </div>
    </div>
@endsection
