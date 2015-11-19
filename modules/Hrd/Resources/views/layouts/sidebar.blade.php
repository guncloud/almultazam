<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu">
                    <li class="site-menu-category">General</li>
                    <li class="site-menu-item ">
                        <a href="{{ url('/hrd') }}" data-slug="dashboard">
                            <i class="site-menu-icon wb-home" aria-hidden="true"></i>
                            <span class="site-menu-title">Home</span>
                        </a>
                    </li>

                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)" data-slug="page">
                            <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                            <span class="site-menu-title">Stakeholder</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ url('/hrd/stakeholder') }}" data-slug="page-faq">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Data Pegawai</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ url('/hrd/division') }}" data-slug="page-register">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Data Divisi/Bagian</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ url('/hrd/position') }}" data-slug="page-register">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Data Jabatan</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ url('/hrd/golongan') }}" data-slug="page-register">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Data Golongan</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="site-menu-item ">
                        <a href="{{ url('/hrd/config') }}" data-slug="dashboard">
                            <i class="site-menu-icon wb-settings" aria-hidden="true"></i>
                            <span class="site-menu-title">Setting</span>
                        </a>
                    </li>

                    <li class="site-menu-item ">
                        <a href="{{ url('/hrd/indicator') }}" data-slug="dashboard">
                            <i class="site-menu-icon wb-clipboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Indicator Penilaian</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    {{--<div class="site-menubar-footer">--}}
        {{--<a href="{{ url('') }}" class="fold-show" data-placement="top" data-toggle="tooltip"--}}
           {{--data-original-title="Settings">--}}
            {{--<span class="icon wb-settings" aria-hidden="true"></span>--}}
        {{--</a>--}}
        {{--<a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">--}}
            {{--<span class="icon wb-eye-close" aria-hidden="true"></span>--}}
        {{--</a>--}}
        {{--<a href="{{ url('/auth/logout') }}" data-placement="top" data-toggle="tooltip" data-original-title="Logout">--}}
            {{--<span class="icon wb-power" aria-hidden="true"></span>--}}
        {{--</a>--}}
    {{--</div>--}}
</div>