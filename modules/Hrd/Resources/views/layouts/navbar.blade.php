{{--@inject('config', 'Modules\Siswa\Entities\Config')--}}

<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided" data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search" data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon wb-search" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
            <img class="navbar-brand-logo" src="{{ asset('/logo.jpg') }}" title="Remark">
            <span class="navbar-brand-text"> Remark</span>
        </div>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="hidden-float" id="toggleMenubar">
                    <a data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>

                <li class="hidden-float">
                    <a class="icon wb-search" data-toggle="collapse" href="#site-navbar-search" role="button">
                        <span class="sr-only">Toggle Search</span> Cari..
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
            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="hidden-float">
                    <a class="icon " data-toggle="collapse" href="#" role="button">
                        {{ $year }}
                        {{--@if($config->getYear() == 'unset')--}}
                            {{--<span class="badge badge-radius badge-danger badge-md">--}}
                            {{--<i class="icon fa-warning"></i>--}}
                            {{--<b>Tahun Ajar {{ $config->getYear() }}, atur di menu config</b>--}}
                        {{--</span>--}}
                        {{--@else--}}
                            {{--<span class="badge badge-radius badge-info badge-md">--}}
                            {{--Tahun Ajar {{ $config->getYear() }}--}}
                        {{--</span>--}}
                        {{--@endif--}}
                    </a>
                </li>
                <li class="dropdown">
                    <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="slide-bottom" role="button">
                        <span class="avatar avatar-online">
                        <img src="{{ asset('/portraits/5.jpg') }}" alt="...">
                        <i></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation">
                            <a href="{{ url('/user/'.Auth::user()->id) }}" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
                        </li>
                        <li class="divider" role="presentation"></li>
                        <li role="presentation">
                            <a href="{{ url('/auth/logout') }}" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
                        </li>
                    </ul>
                </li>

            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" id="searchStakeholder" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search" data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>