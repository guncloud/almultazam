<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('LogoAM.ico') }}">
	<title>Kesiswaan</title>

	<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/bootstrap-extend.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/site.min.css') }}">

	<link rel="stylesheet" href="{{ asset('/fonts/font-awesome/font-awesome.css') }}">

	<link rel="stylesheet" href="{{ asset('/vendor/animsition/animsition.css') }}">
	<link rel="stylesheet" href="{{ asset('/vendor/asscrollable/asScrollable.css') }}">
	<link rel="stylesheet" href="{{ asset('/vendor/switchery/switchery.css') }}">
	<link rel="stylesheet" href="{{ asset('/vendor/intro-js/introjs.css') }}">
	<link rel="stylesheet" href="{{ asset('/vendor/slidepanel/slidePanel.css') }}">
	<link rel="stylesheet" href="{{ asset('/vendor/flag-icon-css/flag-icon.css') }}">
	<link rel="stylesheet" href="{{ asset('/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">

	<!-- Fonts -->
	<link rel="stylesheet" href="{{ asset('/fonts/web-icons/web-icons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/fonts/brand-icons/brand-icons.min.css') }}">

	<link rel="stylesheet" href="{{ asset('/css/custom.css') }}">

	<!-- Scripts -->
	<script src="{{ asset('/vendor/modernizr/modernizr.js') }}"></script>
	<script src="{{ asset('/vendor/breakpoints/breakpoints.js') }}"></script>

    <style>
        .btn-fixed{
            position: fixed;
            right: 0;
            z-index: 1000000;
            bottom: 0;
            margin-right: 100px;
            margin-bottom: 20px;
        }
    </style>

    @yield('css')

	<script>
		Breakpoints();
	</script>
</head>
<body class="site-menubar-fold" data-auto-menubar="false">

	@include('siswa::layouts.navbar')
	@include('siswa::layouts.sidebar')
	{{--@include('siswa::layouts.gridmenu')--}}

	<!-- Page -->
		@yield('content')
	<!-- End Page -->

	<footer class="site-footer">
		<span class="site-footer-legal">© Al Multazam 2015</span>
	</footer>

	<!-- Core  -->
	<script src="{{ asset('/vendor/jquery/jquery.js') }}"></script>
	<script src="{{ asset('/vendor/bootstrap/bootstrap.js') }}"></script>
	<script src="{{ asset('/vendor/animsition/jquery.animsition.js') }}"></script>
	<script src="{{ asset('/vendor/asscroll/jquery-asScroll.js') }}"></script>
	<script src="{{ asset('/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
	<script src="{{ asset('/vendor/asscrollable/jquery.asScrollable.all.js') }}"></script>
	<script src="{{ asset('/vendor/ashoverscroll/jquery-asHoverScroll.js') }}"></script>
	<script src="{{ asset('/vendor/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>

	<!-- Plugins -->
	<script src="{{ asset('/vendor/switchery/switchery.min.js') }}"></script>
	<script src="{{ asset('/vendor/intro-js/intro.js') }}"></script>
	<script src="{{ asset('/vendor/screenfull/screenfull.js') }}"></script>
	<script src="{{ asset('/vendor/slidepanel/jquery-slidePanel.js') }}"></script>


	<!-- Scripts -->
	<script src="{{ asset('/js/core.js') }}"></script>
	<script src="{{ asset('/js/site.js') }}"></script>

	<script src="{{ asset('/js/sections/menu.js') }}"></script>
	<script src="{{ asset('/js/sections/menubar.js') }}"></script>
	<script src="{{ asset('/js/sections/sidebar.js') }}"></script>

	<script src="{{ asset('/js/configs/config-colors.js') }}"></script>
	<script src="{{ asset('/js/configs/config-tour.js') }}"></script>

	<script src="{{ asset('/js/components/asscrollable.js') }}"></script>
	<script src="{{ asset('/js/components/animsition.js') }}"></script>
	<script src="{{ asset('/js/components/slidepanel.js') }}"></script>
	<script src="{{ asset('/js/components/switchery.js') }}"></script>
	<script src="{{ asset('/js/components/jquery-placeholder.js') }}"></script>
	<script src="{{ asset('/js/components/material.js') }}"></script>
	<script src="{{ asset('/js/components/bootstrap-datepicker.js') }}"></script>

	<script src="{{ asset('/vendor/toastr/toastr.js') }}"></script>
	<script src="{{ asset('/js/components/toastr.js') }}"></script>
	<script src="{{ asset('/js/jquery.autocomplete.js') }}"></script>

	<script>
		(function(document, window, $) {
			'use strict';

			var Site = window.Site;
			$(document).ready(function() {
				Site.run();
			});
		})(document, window, jQuery);
    </script>

    <script>
        $(function(){
            var notif = "{{ Session::has('info') or '' }}";

            if(notif != ''){
                toastr.success("{{ Session::get('info') }}", 'Info',{
                    positionClass : 'toast-top-full-width',
                });
            };

            $('#searchStudent').autocomplete({
                serviceUrl: "{{ url('/siswa/student/search') }}",
                onSelect: function (suggestion) {
                    window.location.href = "{{ url('/siswa/siswa') }}/"+suggestion.data;
                    //$('#teacher_id').val(suggestion.data);
                }
            });
        })
    </script>
    @yield('js')

</body>
</html>