<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('super-admin.dashboard') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logos/logo-dark.png') }}" alt="" height="46">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logos/logo_sm.png') }}" alt="" height="46">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('super-admin.dashboard') }}" class="logo text-center logo-dark">
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
                <a href="{{ route('super-admin.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#tpa" aria-expanded="false" aria-controls="tpa"
                    class="side-nav-link">
                    <i class="mdi mdi-doctor"></i>
                    <span> Module Creation </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="tpa">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('super-admin.tpa.index')}}">Hospital Empanelment Status</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#super-adminMenu" aria-expanded="false" aria-controls="super-adminMenu"
                    class="side-nav-link">
                    <i class="mdi mdi-shield-account"></i>
                    <span> Admin </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="super-adminMenu">
                    <ul class="side-nav-second-level">

                        <li>
                            <a href="{{ route('super-admin.admins.create') }}">Create Admin</a>
                        </li>

                        <li>
                            <a href="{{ route('super-admin.admins.index') }}">Manage Admin</a>
                        </li>

                        <li>
                            <a href="{{ route('super-admin.admins.import-export') }}">Import Export Admin</a>
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
                            <a href="{{ route('super-admin.users.create') }}">Create User</a>
                        </li>
                        <li>
                            <a href="{{ route('super-admin.users.index') }}">Manage User</a>
                        </li>
                        <li>
                            <a href="{{ route('super-admin.users.import-export') }}">Import Export Users</a>
                        </li>
                    </ul>
                </div>
            </li>

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
                            <a href="{{ route('super-admin.associate-partners.create') }}">Create Associate Partner</a>
                        </li>
                        <li>
                            <a href="{{ route('super-admin.associate-partners.index') }}">Manage Associate Partner</a>
                        </li>
                        <li>
                            <a href="{{ route('super-admin.associate-partners.import-export') }}">Import Export Associate
                                Partner</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#hospitalModule" aria-expanded="false" aria-controls="hospitalModule"
                    class="side-nav-link">
                    <i class="mdi mdi-hospital-building"></i>
                    <span> Hospital </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="hospitalModule">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('super-admin.hospitals.create') }}">Create Hospital ID</a>
                        </li>
                        <li>
                            <a href="{{ route('super-admin.hospitals.index') }}">Manage Hospital Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('super-admin.hospitals.import-export') }}">Import Export Hospitals</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
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
                            <a {{-- href="{{ route('super-admin.tpa.create')}}" --}}>Create TPA</a>
                        </li>
                        <li>
                            <a {{-- href="{{ route('super-admin.tpa.index')}}" --}}>Manage TPA</a>
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
                                        <a href="{{ route('super-admin.patients.create') }}">Create Patient</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('super-admin.patients.index') }}">Manage Patient</a>
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
                                        <a href="{{ route('super-admin.claims.create') }}">Create Claim</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('super-admin.claims.index') }}">Manage Claims</a>
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
                                        <a href="{{ route('super-admin.claimants.create') }}">Create Claimant</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('super-admin.claimants.index') }}">Manage Claimants</a>
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
                                        <a href="{{ route('super-admin.borrowers.index') }}">Manage Borrowers</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>

           {{--  <li class="side-nav-item">
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
                                        <a href="{{ route('super-admin.patients.create') }}">Create Patient</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('super-admin.patients.index') }}">Manage Patient</a>
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
                                        <a href="{{ route('super-admin.claims.create') }}">Create Claim</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('super-admin.claims.index') }}">Manage Claims</a>
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
                                    <li style="display:none;">
                                        <a href="{{ route('super-admin.claimants.create') }}">Create Claimant</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('super-admin.claimants.index') }}">Manage Claimants</a>
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
                                        <a href="{{ route('super-admin.borrowers.index') }}">Manage Borrowers</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li> --}}


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#claimProcessingModule" aria-expanded="false" aria-controls="claimProcessingModule"
                    class="side-nav-link">
                    <i class="mdi mdi-hospital-building"></i>
                    <span> Pending for Assigning </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="claimProcessingModule">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('super-admin.assigning-pre-assessment.index') }}">Assigning Status for Pre-Assessment</a>
                        </li>
                        <li>
                            <a href="{{ route('super-admin.assigning-claim-processing.index') }}">Assigning Status for Claim Processing</a>
                        </li>
                        <li>
                            <a href="{{ route('super-admin.assigning-final-assessment.index') }}">Assigning Status for Final-Assessment / Claim Authorization</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#claimProcessingPendingModule" aria-expanded="false" aria-controls="claimProcessingPendingModule"
                    class="side-nav-link">
                    <i class="mdi mdi-hospital-building"></i>
                    <span> Pending for Processing </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="claimProcessingPendingModule">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('super-admin.pending-pre-assessment.index') }}">Pending for Pre-Assessment</a>
                        </li>
                        <li>
                            <a href="{{ route('super-admin.pending-claim-processing.index') }}">Pending for Claim Processing</a>
                        </li>
                        <li>
                            <a href="{{ route('super-admin.pending-final-assessment.index') }}">Pending for Final-Assessment</a>
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
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#hospiatl-authorization" aria-expanded="true" aria-controls="hospiatl-authorization" class="">
                                <span> Hospitals </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse show" id="hospiatl-authorization" style="">
                                <ul class="side-nav-third-level">                                    


                                    <li>
                                        <a href="{{ route('super-admin.hospital-authorizations.index') }}">Hospital Authorization</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('super-admin.hospital-tie-up-authorizations.index') }}">Tie Ups</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('super-admin.hospital-empstatus-authorizations.index') }}">Emanelment Status</a>
                                    </li>

                                    

                                </ul>
                            </div>
                        </li>

                        
                        <li>
                            <a href="{{ route('super-admin.claimant-authorizations.index') }}">Claimant Authorization</a>
                        </li>
                        <li>
                            <a href="{{ route('super-admin.borrower-authorizations.index') }}">Borrower Authorization</a>
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
            </li>

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
                            <a href="{{ route('super-admin.password.form') }}">Change Password</a>
                        </li> --}}
                        <li>
                            <a href="{{ route('super-admin.my-account.edit', Auth::guard('super-admin')->id()) }}">My Profile</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <!-- Help Box -->
        <div class="help-box text-white text-center">
            <a href="{{ route('super-admin.logout') }}" class="btn btn-outline-light btn-sm"
                onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">Logout</a>
            <form id="sidebar-logout-form"
                action="{{ 'App\Models\Admin' == Auth::getProvider()->getModel() ? route('super-admin.logout') : route('super-admin.logout') }}"
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
