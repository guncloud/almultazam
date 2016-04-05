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

        <style>
            .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
            .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
            .autocomplete-selected { background: #F0F0F0; }
            .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
            .autocomplete-group { padding: 2px 5px; }
            .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }

            .content-header .breadcrumb{
                top: 5px;
            }
            .box-header>.box-tools {
                top: 10px;
            }
        </style>

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
                @yield('content')
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

        <script src="{{ asset('/js/jquery.autocomplete.js') }}"></script>

        <script>
            $(function(){
                $('#searchStakeholder').autocomplete({
                    serviceUrl: "{{ url('/hrd/stakeholder/search') }}",
                    onSelect: function (suggestion) {
                        window.location.href = "{{ url('/hrd/stakeholder') }}/"+suggestion.data;
                        //$('#teacher_id').val(suggestion.data);
                    }
                });

                $('.btn_delete_action').click(function(e){
                    e.preventDefault();
                    var r = confirm('Yakin akan menghapus');

                    if (r == true) {
                        $(this).closest("form").submit();
                    } else {
                        return false;
                    }
                });
            });
        </script>

        @yield('js')
    </body>
</html>
