<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/portraits/5.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->username }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" id="searchStakeholder" class="form-control" placeholder="Search...">
                      <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                      </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>Stakeholder</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ url('/hrd/stakeholder') }}">
                            <i class="fa fa-circle-o"></i>
                            Data Pegawai
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/hrd/division') }}">
                            <i class="fa fa-circle-o"></i>
                            Data Divisi/Bagian
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/hrd/position') }}">
                            <i class="fa fa-circle-o"></i>
                            Data Jabatan
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/hrd/golongan') }}">
                            <i class="fa fa-circle-o"></i>
                            Data Golongan
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ url('/hrd/config') }}">
                    <i class="fa fa-gears"></i>
                    <span class="site-menu-title">Setting</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/hrd/indicator') }}">
                    <i class="fa fa-clipboard"></i>
                    <span>Indicator Penilaian</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>