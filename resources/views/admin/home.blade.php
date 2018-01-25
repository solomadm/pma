@extends('admin.layouts.app')

@section('page_title')
	{{Auth::user()->conference ? Auth::user()->conference->name : 'Your '}} Dashboard
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Home</h3>
					</div>
					<div class="box-body">
						Start creating your amazing application!
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
@endsection
