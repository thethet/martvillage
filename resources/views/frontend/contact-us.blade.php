@extends('frontend.layout')

@section('main')
	<main>
		<div class="container margin_60">
			<br><br><br><br><br><br>
			<div class="row">
				<div class="col-md-8 col-sm-8">
					<div class="form_title">
						<h3><strong><i class="icon-pencil"></i></strong>Fill the form below</h3>
						<p>
							Mussum ipsum cacilds, vidis litro abertis.
						</p>
					</div>
					<div class="step">

						<div id="message-contact"></div>
						{!! Form::open(array('route' => 'frontend.contact-us.mail-sending','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'contactform')) !!}
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" class="form-control" id="name_contact" name="first_name" placeholder="Enter Name">
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" class="form-control" id="lastname_contact" name="last_name" placeholder="Enter Last Name">
									</div>
								</div>
							</div>
							<!-- End row -->
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" id="email_contact" name="email" class="form-control" placeholder="Enter Email">
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Phone</label>
										<input type="text" id="phone_contact" name="phone" class="form-control" placeholder="Enter Phone number">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Subject</label>
										<input type="text" id="verify_contact" name="subject" class=" form-control" placeholder="Write your subject">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Message</label>
										<textarea rows="5" id="message_contact" name="message" class="form-control add_bottom_30" placeholder="Write your message" style="height:200px;"></textarea>
										<input type="submit" value="Submit" class="btn_1" id="submit-contact">
									</div>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
				<!-- End col-md-8 -->

				<div class="col-md-4 col-sm-4">
					<div class="box_style_1">
						<span class="tape"></span>
						<h4><b>Address <span><i class="icon-pin pull-right"></i></span></b></h4>
						<p>
							<b>MSCT PTE LTD</b>
							<br>111 North Bridge Road,
							#05-39 Peninsula Plaza,
							Singapore 179098

						</p>
						<hr>
						<h4><b>Help center <span><i class="icon-help pull-right"></i></span></b></h4>
						<p>
							Lorem ipsum dolor sit amet, vim id accusata sensibus, id ridens quaeque qui. Ne qui vocent ornatus molestie.
						</p>
						<ul id="contact-info">
							<li>+95 9976477180 / +65 9430 8389</li>
							<li><a href="#">msctpteltd@gmail.com</a>
							</li>
						</ul>
					</div>
					<div class="box_style_4">
						<i class="icon_set_1_icon-57"></i>
						<h4>Need <span>Help?</span></h4>
						<a href="tel://+959422334408" class="phone">Viber +95 942 233 4408</a>
						<small>Monday to Friday 9.00am - 7.30pm</small>
					</div>
				</div>
				<!-- End col-md-4 -->
			</div>
			<!-- End row -->

			<div class="row">
				<div id="map_contact"></div>
			</div>
		</div>
		<!-- End container -->
	</main>
@stop

@section('my-script')
	<script>
		function initMap() {
			var uluru = {lat: 1.2923112, lng: 103.85080749999997};
			var title = 'Peninsula Plaza, Singapore';
			var map = new google.maps.Map(document.getElementById('map_contact'), {
				zoom: 14,
				center: uluru
			});
			var marker = new google.maps.Marker({
				position: uluru,
				title: title,
				map: map,
			});
			marker.addListener('click', function() {
				infowindow.open(map, marker);
			});
		}
	</script>
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcmhyn5mdSFUfxUaeryVGqvNYvMUIKiuA&callback=initMap">
	</script>
@stop
