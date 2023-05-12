<header class="container">
	<nav class="is-flex is-align-items-center is-justify-content-space-between">
		<div class="is-flex-order-2">
			<h2>
				<a href="{{ route('home') }}">
					BookTickets
				</a>
			</h2>
		</div>
		<div class="is-flex-order-1">
			<ul class="columns m-0 is-align-items-center">
				@if (Auth::check())
				<li class="column">
					Howdy, <b>{{ Auth::user()->first_name }}</b>
				</li>
				@endif
			</ul>
		</div>
		<div class="is-flex-order-3">
			<ul class="columns m-0 is-align-items-center">
				@if (Auth::check())
				<li class="column">
					<a href="{{ route('bookings') }}">
						Bookings
					</a>
				</li>
				<li class="column">
					<a href="{{ route('signout') }}">
						Logout
					</a>
				</li>
				@else
				<li class="column">
					<a href="{{ route('signin') }}">
						Login
					</a>
				</li>
				@endif
			</ul>
		</div>
	</nav>
</header>