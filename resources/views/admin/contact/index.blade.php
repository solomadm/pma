@extends('admin.layouts.app')

@section('page_title')
    Manage Contacts
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <contacts-list :values="{{ json_encode($values) }}"
                               :link-export-csv="'{{ route('admin.contact.export') }}'"
                ></contacts-list>
            </div>
        </div>
    </div>
@endsection