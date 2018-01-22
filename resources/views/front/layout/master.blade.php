<!DOCTYPE html>
<html class="" lang="en">
	<head>
		@include('front.partials.header')
	</head>

	<body>
		
    	<div class="wrapper white-bg">
			<!-- PAGE -->
			<div class="header">
				@include('front.partials.top-menu')
				@include('front.partials.menu')
			</div>
			
			@yield('content')
			@include('front.partials.footer')
		</div>
		
		@include('front.partials.pop-up-login')
		@include('slot.vars')
		@include('front.partials.js_footer')
		@yield('scripts')
	</body>
</html>


