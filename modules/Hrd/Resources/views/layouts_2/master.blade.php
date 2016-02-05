<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>
        <link rel="icon" type="image/png" href="{{ asset('LogoAM.ico') }}">
        <title>Hrd</title>

        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{ asset('/adminlte/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('/adminlte/ext/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('/adminlte/ext/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('/adminlte/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('/adminlte/dist/css/skins/skin-green.min.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        @yield('css')

    </head>
    <body class="sidebar-collapse skin-green sidebar-mini">
    <!-- Site wrapper -->
        <div class="wrapper">
            @include('hrd::layouts_2.header')
            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            @include('hrd::layouts_2.sidebar')
            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        {{ $title or 'Kepegawaian' }}
                        <small> {{ $subtitle or '' }} </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Default box -->
                    <div class="box">
                        @yield('content')
                    </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            @include('hrd::layouts_2.footer')
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="{{ asset('/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="{{ asset('/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- SlimScroll -->
        <script src="{{ asset('/adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('/adminlte/plugins/fastclick/fastclick.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('/adminlte/dist/js/app.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('/adminlte/dist/js/demo.js') }}"></script>

        @yield('js')
    </body>
</html>
