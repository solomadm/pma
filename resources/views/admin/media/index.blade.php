@extends('admin.layouts.app')

@section('page_title')
    Manage Media
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <media-list :values="{{ json_encode($values) }}"
                            :link-export-csv="'{{ route('admin.media.export') }}'"
                ></media-list>
            </div>
        </div>
    </div>
@endsection
