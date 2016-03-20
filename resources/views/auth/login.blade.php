<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/login_form/css/style.css') }}">
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
            margin-top: 90px;
            padding-left: 20px;
            border-bottom: solid 1px lightgrey;
        }
    </style>
</head>
<body>


<div class="jumbotron" style="background-color: #8E9513; color: white; padding-top: 3px; padding-bottom: 3px">
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

    <div class="container">
        <section id="content">
            <form action="{{ url('/auth/login') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h1>Login Form</h1>
                <div>
                    <input type="text" name="username" placeholder="Username" required="" id="username" />
                </div>
                <div>
                    <input type="password" name="password" placeholder="Password" required="" id="password" />
                </div>
                <div>
                    <input type="hidden" class="btn btn-primary" value="Log in" />
                    <button type="submit" class="btn btn-success pull-right" style="margin-right: 35px">
                        Login
                    </button>
                    <div class="clearfix"></div>
                    <br>
                    <br>
                </div>
            </form><!-- form -->
        </section><!-- content -->
    </div><!-- container -->

    <div class="footer">
        &copy Al Multazam 2015
    </div>
</div>

<script src="{{ asset('/login_form/js/index.js') }}"></script>

</body>
</html>