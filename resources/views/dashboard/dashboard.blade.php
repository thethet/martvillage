@extends('layouts.layout')

@section('page-title')
	Dashboard
@stop

@section('main')
	<div class="main-content">

			<div class="row">
				<!-- Profile Info and Notifications -->
				<div class="col-md-6 col-sm-8 clearfix">
					<ul class="user-info pull-left pull-none-xsm">
						<!-- Profile Info -->
						<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="assets/images/thumb-1@2x.png" alt="" class="img-circle" width="44" />
								@if(Auth::user())
									{{ Auth::user()->name }}
								@endif
							</a>

							<ul class="dropdown-menu">
								<!-- Reverse Caret -->
								<li class="caret"></li>

								<!-- Profile sub-links -->
								<li>
									<a href="extra-timeline.html">
										<i class="entypo-user"></i>
										Edit Profile
									</a>
								</li>

								<li>
									<a href="mailbox.html">
										<i class="entypo-mail"></i>
										Inbox
									</a>
								</li>

								<li>
									<a href="extra-calendar.html">
										<i class="entypo-calendar"></i>
										Calendar
									</a>
								</li>

								<li>
									<a href="#">
										<i class="entypo-clipboard"></i>
										Tasks
									</a>
								</li>
							</ul>
						</li>
					</ul>

					{{-- <ul class="user-info pull-left pull-right-xs pull-none-xsm">
						<!-- Raw Notifications -->
						<li class="notifications dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<i class="entypo-attention"></i>
								<span class="badge badge-info">6</span>
							</a>

							<ul class="dropdown-menu">
								<li class="top">
									<p class="small">
										<a href="#" class="pull-right">Mark all Read</a>
										You have <strong>3</strong> new notifications.
									</p>
								</li>

								<li>
									<ul class="dropdown-menu-list scroller">
										<li class="unread notification-success">
											<a href="#">
												<i class="entypo-user-add pull-right"></i>

												<span class="line">
													<strong>New user registered</strong>
												</span>

												<span class="line small">
													30 seconds ago
												</span>
											</a>
										</li>

										<li class="unread notification-secondary">
											<a href="#">
												<i class="entypo-heart pull-right"></i>

												<span class="line">
													<strong>Someone special liked this</strong>
												</span>

												<span class="line small">
													2 minutes ago
												</span>
											</a>
										</li>

										<li class="notification-primary">
											<a href="#">
												<i class="entypo-user pull-right"></i>

												<span class="line">
													<strong>Privacy settings have been changed</strong>
												</span>

												<span class="line small">
													3 hours ago
												</span>
											</a>
										</li>

										<li class="notification-danger">
											<a href="#">
												<i class="entypo-cancel-circled pull-right"></i>

												<span class="line">
													John cancelled the event
												</span>

												<span class="line small">
													9 hours ago
												</span>
											</a>
										</li>

										<li class="notification-info">
											<a href="#">
												<i class="entypo-info pull-right"></i>

												<span class="line">
													The server is status is stable
												</span>

												<span class="line small">
													yesterday at 10:30am
												</span>
											</a>
										</li>

										<li class="notification-warning">
											<a href="#">
												<i class="entypo-rss pull-right"></i>

												<span class="line">
													New comments waiting approval
												</span>

												<span class="line small">
													last week
												</span>
											</a>
										</li>
									</ul>
								</li>

								<li class="external">
									<a href="#">View all notifications</a>
								</li>
							</ul>
						</li>

						<!-- Message Notifications -->
						<li class="notifications dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<i class="entypo-mail"></i>
								<span class="badge badge-secondary">10</span>
							</a>

							<ul class="dropdown-menu">
								<li>
									<form class="top-dropdown-search">

										<div class="form-group">
											<input type="text" class="form-control" placeholder="Search anything..." name="s" />
										</div>

									</form>

									<ul class="dropdown-menu-list scroller">
										<li class="active">
											<a href="#">
												<span class="image pull-right">
													<img src="assets/images/thumb-1@2x.png" width="44" alt="" class="img-circle" />
												</span>

												<span class="line">
													<strong>Luc Chartier</strong>
													- yesterday
												</span>

												<span class="line desc small">
													This ain’t our first item, it is the best of the rest.
												</span>
											</a>
										</li>

										<li class="active">
											<a href="#">
												<span class="image pull-right">
													<img src="assets/images/thumb-2@2x.png" width="44" alt="" class="img-circle" />
												</span>

												<span class="line">
													<strong>Salma Nyberg</strong>
													- 2 days ago
												</span>

												<span class="line desc small">
													Oh he decisively impression attachment friendship so if everything.
												</span>
											</a>
										</li>

										<li>
											<a href="#">
												<span class="image pull-right">
													<img src="assets/images/thumb-3@2x.png" width="44" alt="" class="img-circle" />
												</span>

												<span class="line">
													Hayden Cartwright
													- a week ago
												</span>

												<span class="line desc small">
													Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
												</span>
											</a>
										</li>

										<li>
											<a href="#">
												<span class="image pull-right">
													<img src="assets/images/thumb-4@2x.png" width="44" alt="" class="img-circle" />
												</span>

												<span class="line">
													Sandra Eberhardt
													- 16 days ago
												</span>

												<span class="line desc small">
													On so attention necessary at by provision otherwise existence direction.
												</span>
											</a>
										</li>
									</ul>
								</li>

								<li class="external">
									<a href="mailbox.html">All Messages</a>
								</li>
							</ul>
						</li>

						<!-- Task Notifications -->
						<li class="notifications dropdown">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<i class="entypo-list"></i>
								<span class="badge badge-warning">1</span>
							</a>

							<ul class="dropdown-menu">
								<li class="top">
									<p>You have 6 pending tasks</p>
								</li>

								<li>
									<ul class="dropdown-menu-list scroller">
										<li>
											<a href="#">
												<span class="task">
													<span class="desc">Procurement</span>
													<span class="percent">27%</span>
												</span>

												<span class="progress">
													<span style="width: 27%;" class="progress-bar progress-bar-success">
														<span class="sr-only">27% Complete</span>
													</span>
												</span>
											</a>
										</li>
										<li>
											<a href="#">
												<span class="task">
													<span class="desc">App Development</span>
													<span class="percent">83%</span>
												</span>

												<span class="progress progress-striped">
													<span style="width: 83%;" class="progress-bar progress-bar-danger">
														<span class="sr-only">83% Complete</span>
													</span>
												</span>
											</a>
										</li>
										<li>
											<a href="#">
												<span class="task">
													<span class="desc">HTML Slicing</span>
													<span class="percent">91%</span>
												</span>

												<span class="progress">
													<span style="width: 91%;" class="progress-bar progress-bar-success">
														<span class="sr-only">91% Complete</span>
													</span>
												</span>
											</a>
										</li>
										<li>
											<a href="#">
												<span class="task">
													<span class="desc">Database Repair</span>
													<span class="percent">12%</span>
												</span>

												<span class="progress progress-striped">
													<span style="width: 12%;" class="progress-bar progress-bar-warning">
														<span class="sr-only">12% Complete</span>
													</span>
												</span>
											</a>
										</li>
										<li>
											<a href="#">
												<span class="task">
													<span class="desc">Backup Create Progress</span>
													<span class="percent">54%</span>
												</span>

												<span class="progress progress-striped">
													<span style="width: 54%;" class="progress-bar progress-bar-info">
														<span class="sr-only">54% Complete</span>
													</span>
												</span>
											</a>
										</li>
										<li>
											<a href="#">
												<span class="task">
													<span class="desc">Upgrade Progress</span>
													<span class="percent">17%</span>
												</span>

												<span class="progress progress-striped">
													<span style="width: 17%;" class="progress-bar progress-bar-important">
														<span class="sr-only">17% Complete</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</li>

								<li class="external">
									<a href="#">See all tasks</a>
								</li>
							</ul>
						</li>
					</ul> --}}
				</div>


				<!-- Raw Links -->
				<div class="col-md-6 col-sm-4 clearfix hidden-xs">

					<ul class="list-inline links-list pull-right">

						<!-- Language Selector -->
						<li class="dropdown language-selector">

							Language: &nbsp;
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
								<img src="assets/images/flags/flag-uk.png" width="16" height="16" />
							</a>

							<ul class="dropdown-menu pull-right">
								{{-- <li>
									<a href="#">
										<img src="assets/images/flags/flag-de.png" width="16" height="16" />
										<span>Deutsch</span>
									</a>
								</li> --}}
								<li class="active">
									<a href="#">
										<img src="assets/images/flags/flag-uk.png" width="16" height="16" />
										<span>English</span>
									</a>
								</li>
								{{-- <li>
									<a href="#">
										<img src="assets/images/flags/flag-fr.png" width="16" height="16" />
										<span>François</span>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="assets/images/flags/flag-al.png" width="16" height="16" />
										<span>Shqip</span>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="assets/images/flags/flag-es.png" width="16" height="16" />
										<span>Español</span>
									</a>
								</li> --}}
							</ul>

						</li>

						<li class="sep"></li>


						{{-- <li>
							<a href="#" data-toggle="chat" data-collapse-sidebar="1">
								<i class="entypo-chat"></i>
								Chat

								<span class="badge badge-success chat-notifications-badge is-hidden">0</span>
							</a>
						</li> --}}

						<li class="sep"></li>

						<li>
							<a href="{{ url('/logout') }}">
								Log Out <i class="entypo-logout right"></i>
							</a>
						</li>
					</ul>

				</div>

			</div>

			<hr />

			<ol class="breadcrumb bc-3" >
				<li>
					<a href="index.html"><i class="fa-home"></i>Home</a>
				</li>
				<li>

					<a href="forms-main.html">Forms</a>
				</li>
				<li class="active">

					<strong>Data Validation</strong>
				</li>
			</ol>

			<h2>Form Validation</h2>
			<br />

			<div class="panel panel-primary">

				<div class="panel-heading">
					<div class="panel-title">All fields have validation rules <small><code>data-validate="rule1,rule2,...,ruleN"</code></small></div>

					<div class="panel-options">
						<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
						<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
						<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
					</div>
				</div>

				<div class="panel-body">

					<form role="form" id="form1" method="post" class="validate">

						<div class="form-group">
							<label class="control-label">Required Field + Custom Message</label>

							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
						</div>

						<div class="form-group">
							<label class="control-label">Email Field</label>

							<input type="text" class="form-control" name="email" data-validate="email" placeholder="Email Field" />
						</div>

						<div class="form-group">
							<label class="control-label">Input Min Field</label>

							<input type="text" class="form-control" name="min_field" data-validate="number,minlength[4]" placeholder="Numeric + Minimun Length Field" />
						</div>

						<div class="form-group">
							<label class="control-label">Input Max Field</label>

							<input type="text" class="form-control" name="max_field" data-validate="maxlength[2]" placeholder="Maximum Length Field" />
						</div>

						<div class="form-group">
							<label class="control-label">Numeric Field</label>

							<input type="text" class="form-control" name="number" data-validate="number" placeholder="Numeric Field" />
						</div>

						<div class="form-group">
							<label class="control-label">URL Field</label>

							<input type="text" class="form-control" name="url" data-validate="required,url" placeholder="URL" />
						</div>

						<div class="form-group">
							<label class="control-label">Credit Card Field</label>

							<input type="text" class="form-control" name="creditcard" data-validate="required,creditcard" placeholder="Credit Card" />
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-success">Validate</button>
							<button type="reset" class="btn">Reset</button>
						</div>

					</form>

				</div>

			</div>
			<!-- Footer -->
			<footer class="main">
				Copyright &copy; 2017 All Rights Reserved. <strong>MSCT Co.Ltd</strong>
			</footer>
		</div>
@stop

