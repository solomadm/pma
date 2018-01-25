@extends('admin.layouts.app')

@section('page_title')
    Manage Speakers
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Speakers</h3>

                        <speaker-button-new
                                :asset-images="{{GeneralHelper::ImageCollectionToSelect2(Auth::user()->conference->assets->where('type','speaker'))}}"></speaker-button-new>

                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <speaker-table
                                    :values="{{ GeneralHelper::CollectionToTable(Auth::user()->conference->speakers) }}"
                                    :asset-images="{{GeneralHelper::ImageCollectionToSelect2(Auth::user()->conference->assets->where('type','speaker'))}}"></speaker-table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>
    </div>
@endsection
