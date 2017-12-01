<div class="sidebar-menu">
	<div class="sidebar-menu-inner">
		<header class="logo-env">
			<!-- logo -->
			<div class="logo">
				<a href="{{ url("dashboard") }}">
					{{-- <img src="assets/images/logo@2x.png" width="120" alt="" /> --}}
					CARGO MANAGEMENT
				</a>
			</div>

			<!-- logo collapse icon -->
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>


			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>

		</header>


		<ul id="main-menu" class="main-menu">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
			<li class="has-sub">
				<a href="index.html">
					<i class="entypo-gauge"></i>
					<span class="title">Dashboard</span>
				</a>
				<ul>
					<li>
						<a href="index.html">
							<span class="title">Dashboard 1</span>
						</a>
					</li>
					<li>
						<a href="dashboard-2.html">
							<span class="title">Dashboard 2</span>
						</a>
					</li>
					<li>
						<a href="dashboard-3.html">
							<span class="title">Dashboard 3</span>
						</a>
					</li>
					<li class="has-sub">
						<a href="skin-black.html">
							<span class="title">Skins</span>
						</a>
						<ul>
							<li>
								<a href="skin-black.html">
									<span class="title">Black Skin</span>
								</a>
							</li>
							<li>
								<a href="skin-white.html">
									<span class="title">White Skin</span>
								</a>
							</li>
							<li>
								<a href="skin-purple.html">
									<span class="title">Purple Skin</span>
								</a>
							</li>
							<li>
								<a href="skin-cafe.html">
									<span class="title">Cafe Skin</span>
								</a>
							</li>
							<li>
								<a href="skin-red.html">
									<span class="title">Red Skin</span>
								</a>
							</li>
							<li>
								<a href="skin-green.html">
									<span class="title">Green Skin</span>
								</a>
							</li>
							<li>
								<a href="skin-yellow.html">
									<span class="title">Yellow Skin</span>
								</a>
							</li>
							<li>
								<a href="skin-blue.html">
									<span class="title">Blue Skin</span>
								</a>
							</li>
							<li>
								<a href="skin-facebook.html">
									<span class="title">Facebook Skin</span>
									<span class="badge badge-secondary badge-roundless">New</span>
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="highlights.html">
							<span class="title">What's New</span>
							<span class="badge badge-success badge-roundless">v2.0</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="opened active has-sub">
				<a href="{{ url('settings') }}">
					<i class="entypo-cog"></i>
					<span class="title">Settings</span>
				</a>
				<ul>
					@permission('company-list')
					<li>
						<a href="{{ url('/companies') }}">
							<i class="entypo-suitcase"></i>
							<span class="title">Company</span>
						</a>
					</li>
					@endpermission

					@permission('location-list')
					<li>
						<a href="{{ url('/locations') }}">
							<i class="entypo-location"></i>
							<span class="title">Location</span>
						</a>
					</li>
					@endpermission

					@permission('price-list')
					<li>
						<a href="{{ url('/prices') }}">
							<i class="fa fa-money"></i>
							<span class="title">Price</span>
						</a>
					</li>
					@endpermission

					@permission('role-list')
					<li>
						<a href="{{ url('/roles') }}">
							<i class="entypo-flow-tree"></i>
							<span class="title">Role</span>
						</a>
					</li>
					@endpermission

					@permission('permission-list')
					<li>
						<a href="{{ url('/permissions') }}">
							<i class="entypo-user"></i>
							<span class="title">Permission</span>
						</a>
					</li>
					@endpermission
				</ul>
			</li>

			@permission('user-list')
			<li>
				<a href="{{ url('/users') }}">
					<i class="entypo-users"></i>
					<span class="title">Users</span>
				</a>
			</li>
			@endpermission

			@permission('lotin-list')
			<li>
				<a href="{{ url('/lotins') }}">
					<i class="fa fa-truck"></i>
					<span class="title">Lot-in</span>
				</a>
			</li>
			@endpermission

			@permission('tracking-list')
			<li>
				<a href="{{ url('/trackings') }}">
					<i class="fa fa-map"></i>
					<span class="title">Tracking</span>
				</a>
			</li>
			@endpermission

			@permission('collection-list')
			<li>
				<a href="{{ url('/collections') }}">
					<i class="fa fa-database"></i>
					<span class="title">Collection</span>
				</a>
			</li>
			@endpermission

			@permission('lotbalance-list')
			<li>
				<a href="{{ url('/lotbalances') }}">
					<i class="fa fa-shopping-cart"></i>
					<span class="title">Lot Balance</span>
				</a>
			</li>
			@endpermission

			@permission('message-list')
			<li>
				<a href="{{ url('/messages') }}">
					<i class="entypo-mail"></i>
					<span class="title">Messages</span>
					{{-- <span class="badge badge-secondary">8</span> --}}
				</a>
				{{-- <ul>
					<li>
						<a href="mailbox.html">
							<i class="entypo-inbox"></i>
							<span class="title">Inbox</span>
						</a>
					</li>
					<li>
						<a href="mailbox-compose.html">
							<i class="entypo-pencil"></i>
							<span class="title">Compose Message</span>
						</a>
					</li>
					<li>
						<a href="mailbox-message.html">
							<i class="entypo-attach"></i>
							<span class="title">View Message</span>
						</a>
					</li>
				</ul> --}}
			</li>
			@endpermission

			@permission('report-list')
			<li>
				<a href="{{ url('/reports') }}">
					<i class="entypo-chart-bar"></i>
					<span class="title">Charts</span>
				</a>
			</li>
			@endpermission

			@permission('member-list')
			<li>
				<a href="{{ url('/members') }}">
					<i class="fa fa-user-secret"></i>
					<span class="title">Members</span>
				</a>
			</li>
			@endpermission

			@permission('outgoing-list')
			<li>
				<a href="{{ url('/outgoings') }}">
					<i class="fa fa-shopping-cart"></i>
					<span class="title">Outgoing</span>
				</a>
			</li>
			@endpermission

			@permission('incoming-list')
			<li>
				<a href="{{ url('/incomings') }}">
					<i class="fa fa-truck"></i>
					<span class="title">Incoming</span>
				</a>
			</li>
			@endpermission
		</ul>

	</div>

</div>
