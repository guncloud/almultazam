<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu">
                    <li class="site-menu-category">General</li>
                    <li class="site-menu-item">
                        <a href="{{ url('/siswa') }}" data-slug="dashboard">
                            <i class="site-menu-icon wb-home" aria-hidden="true"></i>
                            <span class="site-menu-title">Home</span>
                        </a>
                    </li>

                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)" data-slug="page">
                            <i class="site-menu-icon fa-database" aria-hidden="true"></i>
                            <span class="site-menu-title">Data</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ url('/siswa/siswa') }}" data-slug="page-faq">
                                    <i class="wb-menu-icon" aria-hidden="true"></i>
                                    <span class="site-menu-title">Siswa</span>
                                </a>
                            </li>
                            @if(Auth::user()->is('admin') or Auth::user()->is('root'))
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ url('/siswa/teacher') }}" data-slug="page-faq">
                                        <i class="wb-menu-icon " aria-hidden="true"></i>
                                        <span class="site-menu-title">Guru</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ url('/siswa/classroom') }}" data-slug="page-faq">
                                        <i class="wb-menu-icon " aria-hidden="true"></i>
                                        <span class="site-menu-title">Kelas</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ url('/siswa/hostel') }}" data-slug="page-faq">
                                        <i class="wb-menu-icon" aria-hidden="true"></i>
                                        <span class="site-menu-title">Asrama</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ url('/siswa/subject') }}" data-slug="page-faq">
                                        <i class="wb-menu-icon" aria-hidden="true"></i>
                                        <span class="site-menu-title">Mata Pelajaran</span>
                                    </a>
                                </li>
                            @endif

                            @if(Auth::user()->is('pembina') or Auth::user()->is('root'))
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ url('/siswa/ekskul') }}" data-slug="page-faq">
                                        <i class="wb-menu-icon" aria-hidden="true"></i>
                                        <span class="site-menu-title">Ekskul</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ url('/siswa/language') }}" data-slug="page-faq">
                                        <i class="wb-menu-icon" aria-hidden="true"></i>
                                        <span class="site-menu-title">Bahasa</span>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>

                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)" data-slug="page">
                            <i class="site-menu-icon fa-question" aria-hidden="true"></i>
                            <span class="site-menu-title">Help</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ url('/siswa/siswa') }}" data-slug="page-faq">
                                    <i class="wb-menu-icon" aria-hidden="true"></i>
                                    <span class="site-menu-title">Siswa</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="site-menubar-footer">
        <a href="{{ url('/siswa/config') }}" class="fold-show" data-placement="top" data-toggle="tooltip"
           data-original-title="Config">
            <span class="icon wb-settings" aria-hidden="true"></span>
        </a>
        <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
            <span class="icon wb-eye-close" aria-hidden="true"></span>
        </a>
        <a href="{{ url('/auth/logout') }}" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon wb-power" aria-hidden="true"></span>
        </a>
    </div>
</div>