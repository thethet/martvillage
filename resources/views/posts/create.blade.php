@extends('layouts.layout')

@section('page-title')
	Post
@stop

@section('main')
	<div class="main-content">

		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li>
				<a href="{{ url('informations') }}">Information</a>
			</li>
			<li>
				<a href="{{ url('posts') }}">Post Management</a>
			</li>
			<li class="active">
				<strong>New Create Form</strong>
			</li>
		</ol>

		<h2>Post Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>New Create Form</strong>
						</div>

						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::open(array('route' => 'posts.store','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')) !!}

							<div class="form-group {{ $errors->has('tags_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Tag</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-tag"></i></span>
										{!! Form::select('tags_id', ['' => 'Select Tag'] + $tagList->toArray(), null, ['class' => 'form-control select2', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('tags_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('tags_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('post_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Post Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-doc-text"></i></span>
										{!! Form::text('post_name', null, ['placeholder' => 'Post Name','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('post_name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('post_name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Post Image</label>

								<div class="col-sm-5">

									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 470px; height: 265px;" data-trigger="fileinput">
											<img src="http://placehold.it/470x265" alt="...">
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 470px; max-height: 265px"></div>
										<div>
											<span class="btn btn-white btn-file">
												<span class="fileinput-new">Select image</span>
												<span class="fileinput-exists">Change</span>
												<input type="file" name="image" accept="image/*">
											</span>
											<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
										</div>
									</div>

									@if ($errors->has('image'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('image') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Content</label>

								<div class="col-sm-5">
									<div class="row">
										<div class="col-sm-12">
											{!! Form::textarea('content', null, ['placeholder' => 'Content', 'class' => 'form-control', 'id' => 'summernote', 'autocomplete' => 'off']) !!}
											@if ($errors->has('content'))
												<span class="text-danger">
													<strong>{{ $errors->first('content') }}</strong>
												</span>
											@endif
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
									<button type="submit" class="btn btn-success btn-icon">
										Save
										<i class="entypo-floppy"></i>
									</button>
									<button type="reset" class="btn btn-info btn-icon">
										Reset
										<i class="entypo-erase"></i>
									</button>
									<a href="{{ route('posts.index') }}" class="btn btn-orange btn-icon">
										Back
										<i class="entypo-reply"></i>
									</a>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<footer class="main">
			Copyright &copy; 2017 All Rights Reserved. <strong>MSCT Co.Ltd</strong>
		</footer>
	</div>
@stop

@section('my-style')
	<link href="{{ asset('assets/summernote/summernote.css') }}" rel="stylesheet">
@stop

@section('my-script')
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="{{ asset('assets/js/datatables/datatables.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2-bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2.css') }}">

	<!-- Imported scripts on this page -->
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-timepicker.min.js') }}"></script>
	<script src="{{ asset('assets/js/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('assets/js/fileinput.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

	<script src="{{ asset('assets/summernote/summernote.js') }}"></script>

	<script>
		$(document).ready(function(){
			$(window).keydown(function(event){
				if(event.keyCode == 13) {
					event.preventDefault();
					return false;
				}
			});

			$('#summernote').summernote({
				placeholder: 'Post Content',
				tabsize: 2,
				height: 300
			});
		});
	</script>
@stop

