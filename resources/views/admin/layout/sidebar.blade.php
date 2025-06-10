<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{asset('assets/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{auth()->user()->name}}
                            <span class="user-level">{{auth()->user()->role}}</span>
                            {{-- <span class="caret"></span> --}}
                        </span>
                    </a>
                    <div class="clearfix"></div>


                </div>
            </div>
            <ul class="nav nav-primary ">
                <li class="nav-item {{ Request::is('dashboard')?'active':''}}">
                    <a href="/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        {{-- <span class="caret"></span> --}}
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li class="nav-item {{ Request::is('variabel') || Request::is('himpunan')||Request::is('fungsi') ? 'active submenu' : '' }}">
                    <a data-toggle="collapse" href="#master" >
                        <i class="fas fa-database"></i>
                        <p>Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::is('variabel') || Request::is('himpunan')||Request::is('fungsi') ? 'show' : '' }}" id="master">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::is('variabel') ? 'active ' : '' }}">
                                <a href="/variabel">
                                    <span class="sub-item">Variabel</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('himpunan') ? 'active' : '' }}">
                                 <a href="/himpunan">
                                    <span class="sub-item">Himpunan</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('fungsi') ? 'active' : '' }}">
                                 <a href="/fungsi">
                                    <span class="sub-item">Fungsi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#dashboard">
                        <i class="fas fa-users"></i>
                        <p>Warga</p>
                        {{-- <span class="caret"></span> --}}
                    </a>
                </li>


                <li class="mx-4 mt-2">
                    <a href="http://themekita.com/atlantis-bootstrap-dashboard.html"
                        class="btn btn-primary btn-block"><span class="btn-label mr-2">
                        </span>Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
