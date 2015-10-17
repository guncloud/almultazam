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

        .footer{
            /*padding-top: 150px;*/
            margin-top: 300px;
            padding-left: 20px;
            border-bottom: solid 1px lightgrey;
        }
    </style>
</head>
<body>


<div class="jumbotron">
    <div class="container">
        <h1>Selamat Datang</h1>
        <p>Sistem Akademik Al Multazam</p>

    </div>
</div>

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
        <h4 style="text-align: center">Silahkan Login</h4>
        <form action="{{ url('/auth/login') }}" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Username</span>
                    <input type="text" name="username" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Password</span>
                    <input type="password" name="password" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit">Masuk</button>
            </div>
        </form>

    </div>

    <div class="footer">
        &copy Al Multazam 2015
    </div>
</div>

</body>
</html>