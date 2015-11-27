<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Title</title>
		<meta charset="UTF-8">
		<meta name=description content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/bootstrap-extend.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/site.min.css') }}">

		<link rel="stylesheet" href="{{ asset('/fonts/font-awesome/font-awesome.css') }}">

	</head>
	<body>
        @include('root.layout.navbar')
		@yield('content')
	</body>
</html>