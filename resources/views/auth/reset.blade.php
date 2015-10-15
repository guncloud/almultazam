<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
	<style>

		body {
			margin: 0;
			padding: 0;
			padding-top: 0px;
			width: 100%;
			display: table;
			font-weight: 100;
			font-family: 'Lato';
		}

		.productbox {
			background-color:#ffffff;
			padding:10px;
			margin-bottom:10px;
			-webkit-box-shadow: 0 8px 6px -6px  #999;
			-moz-box-shadow: 0 8px 6px -6px  #999;
			box-shadow: 0 8px 6px -6px #999;
		}

		.producttitle {
			font-weight:bold;
			padding:5px 0 5px 0;
		}

		.productprice {
			border-top:1px solid #dadada;
			padding-top:5px;
		}

		.pricetext {
			font-weight:bold;
			font-size:1.4em;
		}

		.footer{
			/*padding-top: 150px;*/
			margin-top: 600px;
			padding-left: 20px;
			border-bottom: solid 1px lightgrey;
		}
	</style>
</head>
<body>
<div class="container">
    @if (Session::has('info'))

        <div class="alert alert-danger">
            <ul>
                {{ Session::get('info') }}
                <a href="{{ url('/') }}">Halaman Utama</a>
            </ul>
        </div>
    @endif
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Reset Password</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form class="form-horizontal" role="form" method="post" action="{{ url('/user/'.Auth::user()->id) }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="_method" value="put">

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="old_password">
							</div>
						</div>

                        <div class="form-group">
							<label class="col-md-4 control-label">New Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="change_password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Ganti Password
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
