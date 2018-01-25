@extends('admin.layouts.app')

@section('page_title')
    Manage Conferences
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Conferences</h3>

                        <conference-button-new
                                :frontend_themes="{{ GeneralHelper::AvailableThemes() }}"></conference-button-new>

                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <conference-table
                                    :values="{{ GeneralHelper::CollectionToTable(App\Conference::all()) }}"
                                    :frontend_themes="{{ GeneralHelper::AvailableThemes() }}"></conference-table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>
    </div>
@endsection
