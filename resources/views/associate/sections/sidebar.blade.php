<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('associate-partner.dashboard') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logos/logo-dark.png') }}" alt="" height="46">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logos/logo_sm.png') }}" alt="" height="46">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('associate-partner.dashboard') }}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logos/logo-dark.png') }}" alt="" height="46">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logos/logo_sm.png') }}" alt="" height="46">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('associate-partner.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#adminMenu" aria-expanded="false" aria-controls="adminMenu"
                    class="side-nav-link">
                    <i class="mdi mdi-shield-account"></i>
                    <span> Admin </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="adminMenu">
                    <ul class="side-nav-second-level">

                        <li>
                            <a onclick="return false;" href="{{ route('associate-partner.admins.create') }}">Create Admin</a>
                        </li>

                        <li>
                            <a onclick="return false;" href="{{ route('associate-partner.admins.index') }}">Manage Admin</a>
                        </li>

                        <li>
                            <a onclick="return false;" href="{{ route('associate-partner.admins.import-export') }}">Import Export Admin</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#userMenu" aria-expanded="false" aria-controls="userMenu"
                    class="side-nav-link">
                    <i class="mdi mdi-account"></i>
                    <span> User </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="userMenu">
                    <ul class="side-nav-second-level">
                        <li>
                            <a onclick="return false;" href="{{ route('associate-partner.users.create') }}">Create User</a>
                        </li>
                        <li>
                            <a onclick="return false;" href="{{ route('associate-partner.users.index') }}">Manage User</a>
                        </li>
                        <li>
                            <a onclick="return false;" href="{{ route('associate-partner.users.import-export') }}">Import Export Users</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#associatePartner" aria-expanded="false"
                    aria-controls="associatePartner" class="side-nav-link">
                    <i class="mdi mdi-account-group"></i>
                    <span> Associate Partner </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="associatePartner">
                    <ul class="side-nav-second-level">                        
                        <li>
                            <a href="{{ route('associate-partner.associate-partners.index')}}">Manage Associate Partner</a>
                        </li>                        
                    </ul>
                </div>
            </li>

            <li class="side-nav-item" style="display:none;">
                <a data-bs-toggle="collapse" href="#hospitalModule" aria-expanded="false" aria-controls="hospitalModule"
                    class="side-nav-link">
                    <i class="mdi mdi-hospital-building"></i>
                    <span> Hospital </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="hospitalModule">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('associate-partner.hospitals.create') }}">Create Hospital ID</a>
                        </li>
                        <li>
                            <a href="{{ route('associate-partner.hospitals.index') }}">Manage Hospital Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('associate-partner.claims.index') }}">Claims</a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#insurer" aria-expanded="false" aria-controls="insurer"
                    class="side-nav-link">
                    <i class="dripicons-heart"></i>
                    <span> Insurer </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="insurer">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="javascript:Void(0)">Create Insurer</a>
                        </li>
                        <li>
                            <a href="javascript:Void(0)">Manage Insurer</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#tpa" aria-expanded="false" aria-controls="tpa"
                    class="side-nav-link">
                    <i class="mdi mdi-doctor"></i>
                    <span> TPA </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="tpa">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="javascript:Void(0)">Create TPA</a>
                        </li>
                        <li>
                            <a href="javascript:Void(0)">Manage TPA</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#authorization" aria-expanded="false"
                    aria-controls="authorization" class="side-nav-link">
                    <i class="uil-shield-check"></i>
                    <span> Authorization </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="authorization">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="javascript:Void(0)">Hospital Authorization</a>
                        </li>
                        <li>
                            <a href="javascript:Void(0)">Associate Partner Authorization</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="javascript:Void(0)" class="side-nav-link">
                    <i class="uil-folder-medical"></i>
                    <span> File Management </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="javascript:Void(0)" class="side-nav-link">
                    <i class="uil-graph-bar"></i>
                    <span> Report Generation </span>
                </a>
            </li> --}}

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings"
                    class="side-nav-link">
                    <i class="dripicons-gear"></i>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="settings">
                    <ul class="side-nav-second-level">
                        {{-- <li>
                            <a href="{{ route('associate-partner.password.form') }}">Change Password</a>
                        </li> --}}
                        <li>
                            <a href="{{ route('associate-partner.my-account.edit', Auth::guard('associate')->id()) }}">My Profile</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <!-- Help Box -->
        <div class="help-box text-white text-center">
            <a href="{{ route('associate-partner.logout') }}" class="btn btn-outline-light btn-sm"
                onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">Logout</a>
            <form id="sidebar-logout-form"
                action="{{ 'App\Models\Admin' == Auth::getProvider()->getModel() ? route('associate-partner.logout') : route('associate-partner.logout') }}"
                method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
