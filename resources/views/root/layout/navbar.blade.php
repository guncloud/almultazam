<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided" data-toggle="menubar">
			<span class="sr-only">Toggle navigation</span>
			<span class="hamburger-bar"></span>
		</button>
		<button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
			<i class="icon wb-more-horizontal" aria-hidden="true"></i>
		</button>
		<button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search" data-toggle="collapse">
			<span class="sr-only">Toggle Search</span>
			<i class="icon wb-search" aria-hidden="true"></i>
		</button>
		<div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
			<img class="navbar-brand-logo" src="{{ asset('/logo.jpg') }}" title="Remark">

		</div>
	</div>
	<ul class="nav navbar-nav">
		<li>
			<a href="{{ url('/user') }}">Users</a>
		</li>

	</ul>

	<ul class="nav navbar-nav navbar-right">

		<li>
			<a href="{{ url('/auth/logout') }}">Logout</a>
		</li>

	</ul>


</nav>