<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('hospital.dashboard') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logos/logo-dark.png') }}" alt="" height="46">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logos/logo_sm.png') }}" alt="" height="46">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('hospital.dashboard') }}" class="logo text-center logo-dark">
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
                <a href="{{ route('hospital.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#hospitalModule" aria-expanded="false" aria-controls="hospitalModule" class="side-nav-link">
                    <i class="mdi mdi-hospital-building"></i>
                    <span> Hospital </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="hospitalModule">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('hospital.hospitals.index') }}">Manage Hospital</a>
                        </li>
                        <li>
                            <a href="{{ route('hospital.hospital-documents.show', auth('hospital')->user()->id) }}">View Documents</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMultiLevel" aria-expanded="false" aria-controls="sidebarMultiLevel" class="side-nav-link">
                    <i class="mdi mdi-doctor"></i>
                    <span> Claims </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMultiLevel" style="">
                    <ul class="side-nav-second-level">

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarSecondLevel" aria-expanded="false" aria-controls="sidebarSecondLevel" class="">
                                <span>  Patients  </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarSecondLevel" style="">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{ route('hospital.patients.create') }}">Create Patient</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('hospital.patients.index') }}">Manage Patient</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarThirdLevel" aria-expanded="false" aria-controls="sidebarThirdLevel" class="">
                                <span> Claims </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarThirdLevel" style="">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{ route('hospital.claims.create') }}">Create Claim</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('hospital.claims.index') }}">Manage Claims</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarFourthLevel" aria-expanded="false" aria-controls="sidebarFourthLevel" class="">
                                <span> Claimants </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarFourthLevel" style="">
                                <ul class="side-nav-third-level">
                                    <li style="display:none;">
                                        <a href="{{ route('hospital.claimants.create') }}">Create Claimant</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('hospital.claimants.index') }}">Manage Claimants</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarFifthLevel" aria-expanded="false" aria-controls="sidebarFifthLevel" class="">
                                <span> Borrowers </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarFifthLevel" style="">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{ route('hospital.borrowers.index') }}">Manage Borrowers</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>
            

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#claims" aria-expanded="false" aria-controls="claims" class="side-nav-link collapsed">
                    <i class="mdi mdi-doctor"></i>
                    <span> Claims </span>
                    <span class="menu-arrow"></span>
                </a>

                <div class="collapse" id="claims" style="">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#patients" aria-expanded="true" aria-controls="patients" class="">
                                <span> Patients </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse show" id="patients" style="">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{ route('hospital.patients.create') }}">Create Patient</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('hospital.patients.index') }}">Manage Patient</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#claims-management" aria-expanded="true" aria-controls="claims-management" class="">
                                <span> Claims </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse show" id="claims-management" style="">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{ route('hospital.claims.create') }}">Create Claim</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('hospital.claims.index') }}">Manage Claims</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#claimant-management" aria-expanded="true" aria-controls="claimant-management" class="">
                                <span> Claimants </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse show" id="claimant-management" style="">
                                <ul class="side-nav-third-level">
                                    
                                    <li>
                                        <a href="{{ route('hospital.claimants.index') }}">Manage Claimants</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#borrowers-management" aria-expanded="true" aria-controls="borrowers-management" class="">
                                <span> Borrowers </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse show" id="borrowers-management" style="">
                                <ul class="side-nav-third-level">
                                  
                                    <li>
                                        <a href="{{ route('hospital.borrowers.index') }}">Manage Borrowers</a>
                                    </li>
                                </ul>
                            </div>
                        </li>   
                    </ul>
                </div>

            </li> --}}

        </ul>

        <!-- Help Box -->
        <div class="help-box text-white text-center">
            <a  href="{{ route('hospital.logout') }}" class="btn btn-outline-light btn-sm"
            onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">Logout</a>
            <form id="sidebar-logout-form" action="{{ 'App\Models\Hospital' == Auth::getProvider()->getModel() ? route('hospital.logout') : route('hospital.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
