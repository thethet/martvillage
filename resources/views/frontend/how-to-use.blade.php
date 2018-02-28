@extends('frontend.layout')

@section('main')
	<main>
		<div class="container margin_60">
			<br><br><br><br><br><br>
			<div class="row">
				<div class="col-md-12">
					<div class="box_style_1">
						<div class="post nopadding">

							@foreach($posts as $post)
								@if($post->post_img == null)
									<img src="http://placehold.it/470x265" alt="..." style="height: 400px; width: 100%; object-fit: contain; border: 2px solid #f8f8f8; padding: 2px;">
								@else
									<img src="{{ asset('uploads/posts/'. $post->post_img) }}" alt="..." style="height: 400px; width: 100%; object-fit: contain; border: 2px solid #f8f8f8; padding: 2px;">
								@endif

								<blockquote class="styled" style="border-left: none;">
									<h2 class="text-center">{{ strtoupper($post->post_name) }}</h2>
									{!! $post->content !!}

									<small>© ShweCargo 2017</small>
								</blockquote>
							@endforeach
						</div>
						<!-- end post -->
					</div>
					<!-- end box_style_1 -->
				</div>
				<!-- End col-md-12-->
			</div>
			<hr>

		</div>
		<!-- End container -->
	</main>
@stop
