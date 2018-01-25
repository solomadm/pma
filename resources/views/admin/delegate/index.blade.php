@extends('admin.layouts.app')

@section('page_title')
    Manage Delegates
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <delegate-list :values="{{ json_encode($values) }}"
                               :asset-images="{{GeneralHelper::ImageCollectionToSelect2(Auth::user()->conference->assets->where('type','delegate'))}}"
                               :link-upload-csv="'{{ route('admin.delegate.upload-csv-page') }}'"
                               :link-get-csv="'{{ route('admin.delegate.get-csv-template') }}'"
                ></delegate-list>
                {{--<div class="box">--}}
                    {{--<div class="box-header with-border">--}}
                        {{--<h3 class="box-title">Delegates</h3>--}}

                        {{--<div class="pull-right">--}}
                            {{--<delegate-button-new></delegate-button-new>--}}

                            {{--<a class="btn btn-xs btn-success" href="{{ route('admin.delegate.upload-csv-page') }}">Upload CSV</a>--}}

                            {{--<a class="btn btn-xs btn-primary" href="{{ route('admin.delegate.get-csv-template') }}">Get CSV template</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="box-body">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<delegate-table :values="{{ json_encode($values) }}"--}}
                                            {{--:asset-images="{{GeneralHelper::ImageCollectionToSelect2(Auth::user()->conference->assets->where('type','delegate'))}}"></delegate-table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection