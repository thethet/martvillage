<div class="sidebar-menu">
	<div class="sidebar-menu-inner">
		<header class="logo-env">
			<!-- logo -->
			<div class="logo">
				<a href="{{ url("dashboard") }}">
					<img src="{{ asset('assets/images/cargo-logo.jpg') }}" width="120" alt="" />
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
			<li @if(Request::segment(1) == 'dashboard' || Request::segment(1) == null) class="active" @endif>
				<a href="{{ url("dashboard") }}">
					<i class="entypo-gauge"></i>
					<span class="title">Dashboard</span>
				</a>
			</li>

			<li @if(Request::segment(1) == 'companies' || Request::segment(1) == 'locations' || Request::segment(1) == 'prices' || Request::segment(1) == 'roles' || Request::segment(1) == 'permissions') class="opened active has-sub" @else class="has-sub" @endif>
				<a href="{{ url('settings') }}">
					<i class="entypo-cog"></i>
					<span class="title">Settings</span>
				</a>
				<ul>
					@permission('nric-code-list')
					<li @if(Request::segment(1) == 'nric-codes') class="active" @endif>
						<a href="{{ url('/nric-codes') }}">
							<i class="entypo-vcard"></i>
							<span class="title">NRIC Code</span>
						</a>
					</li>
					@endpermission

					@permission('nric-township-list')
					<li @if(Request::segment(1) == 'nric-townships') class="active" @endif>
						<a href="{{ url('/nric-townships') }}">
							<i class="entypo-vcard"></i>
							<span class="title">NRIC Township</span>
						</a>
					</li>
					@endpermission

					@permission('permission-list')
					<li @if(Request::segment(1) == 'permissions') class="active" @endif>
						<a href="{{ url('/permissions') }}">
							<i class="entypo-user"></i>
							<span class="title">Permission</span>
						</a>
					</li>
					@endpermission

					@permission('role-list')
					<li @if(Request::segment(1) == 'roles') class="active" @endif>
						<a href="{{ url('/roles') }}">
							<i class="entypo-flow-tree"></i>
							<span class="title">Role</span>
						</a>
					</li>
					@endpermission

					@permission('company-list')
					<li @if(Request::segment(1) == 'companies') class="active" @endif>
						<a href="{{ url('/companies') }}">
							<i class="entypo-suitcase"></i>
							<span class="title">Company</span>
						</a>
					</li>
					@endpermission

					@permission('location-list')
					<li @if(Request::segment(1) == 'locations') class="active" @endif>
						<a href="{{ url('/locations') }}">
							<i class="entypo-location"></i>
							<span class="title">Location</span>
						</a>
					</li>
					@endpermission

					@permission('price-list')
					<li @if(Request::segment(1) == 'prices') class="active" @endif>
						<a href="{{ url('/prices') }}">
							<i class="fa fa-money"></i>
							<span class="title">Price</span>
						</a>
					</li>
					@endpermission

					@permission('member-offer-list')
					<li @if(Request::segment(1) == 'member-offers') class="active" @endif>
						<a href="{{ url('/member-offers') }}">
							<i class="entypo-tag"></i>
							<span class="title">Member Offers</span>
						</a>
					</li>
					@endpermission
				</ul>
			</li>

			@permission('user-list')
			<li @if(Request::segment(1) == 'users') class="active" @endif>
				<a href="{{ url('/users') }}">
					<i class="entypo-users"></i>
					<span class="title">Users</span>
				</a>
			</li>
			@endpermission

			@permission('lotin-list')
			<li @if(Request::segment(1) == 'lotins') class="active" @endif>
				<a href="{{ url('/lotins') }}">
					<i class="fa fa-truck"></i>
					<span class="title">Lot-in</span>
				</a>
			</li>
			@endpermission

			@permission('tracking-list')
			<li @if(Request::segment(1) == 'trackings') class="active" @endif>
				<a href="{{ url('/trackings') }}">
					<i class="fa fa-map"></i>
					<span class="title">Tracking</span>
				</a>
			</li>
			@endpermission

			@permission('collection-list')
			<li @if(Request::segment(1) == 'collections') class="active" @endif>
				<a href="{{ url('/collections') }}">
					<i class="fa fa-database"></i>
					<span class="title">Collections</span>
				</a>
			</li>
			@endpermission

			@permission('lotbalance-list')
			<li @if(Request::segment(1) == 'lotbalances') class="active" @endif>
				<a href="{{ url('/lotbalances') }}">
					<i class="fa fa-shopping-cart"></i>
					<span class="title">Lot Balance</span>
				</a>
			</li>
			@endpermission

			@permission('message-list')
			<li @if(Request::segment(1) == 'messages') class="active" @endif>
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
			<li @if(Request::segment(1) == 'reports') class="active" @endif>
				<a href="{{ url('/reports') }}">
					<i class="entypo-chart-bar"></i>
					<span class="title">Charts</span>
				</a>
			</li>
			@endpermission

			@permission('member-list')
			<li @if(Request::segment(1) == 'members') class="active" @endif>
				<a href="{{ url('/members') }}">
					<i class="fa fa-user-secret"></i>
					<span class="title">Members</span>
				</a>
			</li>
			@endpermission

			@permission('outgoing-list')
			<li @if(Request::segment(1) == 'outgoings') class="active" @endif>
				<a href="{{ url('/outgoings') }}">
					<i class="fa fa-shopping-cart"></i>
					<span class="title">Outgoing</span>
				</a>
			</li>
			@endpermission

			@permission('incoming-list')
			<li @if(Request::segment(1) == 'incomings') class="active" @endif>
				<a href="{{ url('/incomings') }}">
					<i class="fa fa-truck"></i>
					<span class="title">Incoming</span>
				</a>
			</li>
			@endpermission
		</ul>

	</div>

</div>
