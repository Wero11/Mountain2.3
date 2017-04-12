<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Mountain | Admin</title>
                <link rel="shortcut icon" type="image/png" href="{{ asset('public/images/MountainFavIcon.png')}}"/>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<!-- JS Files-->
		<script src="{{ asset('public/js/lib/jquery-2.1.3.min.js')}} "></script>
		<script src="{{ asset('public/js/lib/bootstrap.min.js')}}"></script>
		<script src="{{ asset('public/js/lib/prefixfree.min.js')}}"></script>
		<script src="{{ asset('public/js/lib/html5lightbox.js')}}"></script>
		<script src="{{ asset('public/js/lib/bootstrap-multiselect.js')}}"></script>
		<script src="{{ asset('public/js/lib/jquery.select-multiple.js')}}"></script>
		<script src="{{ asset('public/js/lib/jquery.quicksearch.js')}}"></script>
		<script src="{{ asset('public/js/lib/image-picker.js')}}"></script>
		<script src="{{ asset('public/js/lib/jquery.tmpl.js')}}"></script>
		<script src="{{ asset('public/js/lib/slick.js')}}"></script>
		<script src="{{ asset('public/js/lib/jquery.flexisel.js')}}"></script>
		<script src="{{ asset('public/js/lib/bootstrap-checkbox.js')}}"></script>
		<script src="{{ asset('public/js/lib/jquery.datetimepicker.full.js')}}"></script>
	
		
		<!--CSS Files-->
		<link href="{{ asset('public/css/app.css')}}" rel="stylesheet">
		<link href="{{ asset('public/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{ asset('public/css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
		<link href="{{ asset('public/css/bootstrap/bootstrap-multiselect.css')}}" rel="stylesheet">
		<link href="{{ asset('public/css/select-multiple.css')}}" rel="stylesheet">
		<link href="{{ asset('public/css/slick.css')}}" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{ asset('public/css/flags.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('public/css/jquery.datetimepicker.css')}}" />
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php $baseurl = URL::to('/'); ?>
		<script> var baseurl = "<?php echo $baseurl; ?>"; </script>	
	</head>
	<body id="mountain">
		@section('header')
			@include('partials.header')
		@show	

		@section('menu')
		
			@include('partials.menu')
		@show
			
		@yield('content')

		@section('footer')	
			@include('partials.footer')
		@show		
	</body>
</html>