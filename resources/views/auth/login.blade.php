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
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-md-6 col-md-offset-3 column productbox">
        {{--<img src="http://placehold.it/460x250/e67e22/ffffff&text=HTML5" class="img-responsive">--}}
        <div class="jumbotron">
        	<div class="container">
        		<h1>Welcome</h1>
        		<p>Sistem Akademik Al Multazam</p>

        	</div>
        </div>
        <div class="producttitle">
            Login
        </div>
        <div class="productprice">
            <form action="{{ url('/auth/login') }}" class="form-inline" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="pull-right">
                    <button class="btn btn-primary" type="submit">Masuk</button>
                </div>
                <div class="pricetext">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        &copy Al Multazam 2015
    </div>
</div>

</body>
</html>