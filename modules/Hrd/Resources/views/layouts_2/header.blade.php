<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('hrd') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <ul class="nav navbar-nav">
            <li class="hidden-float" style="margin-left: auto; margin-right: auto;">
                <a class="icon " href="#" role="button" disabled>
                    |
                </a>
            </li>
            <li class="hidden-float" style="margin-left: auto; margin-right: auto;">
                <a class="icon " href="{{ url('hrd/report') }}" role="button">
                    Rapor Penilaian
                </a>
            </li>
            <li class="hidden-float" style="margin-left: auto; margin-right: auto;">
                <a class="icon " href="{{ url('hrd/vacation') }}" role="button">
                    Cuti
                </a>
            </li>
            <li class="hidden-float" style="margin-left: auto; margin-right: auto;">
                <a class="icon " href="{{ url('/tool') }}" role="button">
                    Cover Penilaian
                </a>
            </li>
        </ul>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="hidden-float" style="margin-left: auto; margin-right: auto;">
                    <a class="icon " href="#" role="button" style="color:orange">
                        Tahun Ajar : {{ $year }}
                    </a>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('/portraits/5.jpg') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('portraits/5.jpg') }}" class="img-circle" alt="...">
                            <p>
                                {{ Auth::user()->username }}
                                <small>{{ Auth::user()->roles[0]->name }}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                {{--<li>--}}
                {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </nav>
</header>