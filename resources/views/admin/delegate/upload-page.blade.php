@extends('admin.layouts.app')

@section('page_title')
    Upload Delegates List
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Upload Delegates</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            {!! Form::open(['route' => 'admin.delegate.upload-csv', "class" => "form-inline", "files" => true, 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label class="custom-file">
                                        <input name="file" type="file" id="file" class="custom-file-input" accept=".csv, .xls, .xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        <span class="custom-file-control"></span>
                                    </label>
                                </div>
                                <div class="pull-right">
                                    {!! Form::submit('Submit', ['class'=> 'btn btn-primary']) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-9">
                @if (count($errors) > 0)
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <strong>Errors:</strong>
                        </div>
                        <div class="panel-body">
                            <ul>
                                @if(is_array($errors))
                                    @foreach ($errors as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @else
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection