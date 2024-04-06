<!-- ========== Left Sidebar Start ========== -->
<style>
    .sidebar-content{
    font-size: 13px !important;
    font-family: Arial,
    Helvetica,
    sans-serif !important;
    }
</style>

<div class="sidebar-content left-side-menu">
    <div class="media user-profile mt-2 mb-2">
        <img src="/storage/avatars/{{ auth()->user()->avatar }}" class="avatar-sm rounded-circle mr-2"
             alt="admin-template"/>

        <div class="media-body">
            @if(auth()->check())
                <h6 class="pro-user-name mt-0 mb-0">{{ auth()->user()->first_name }}</h6>
                <span class="pro-user-desc">{{auth()->user()->role}}</span>
            @endif
        </div>
        <div class="dropdown align-self-center profile-dropdown-menu">
            <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
               aria-expanded="false">
                <span data-feather="chevron-down"></span>
            </a>
            <div class="dropdown-menu profile-dropdown">
                <a href="{{ route('settings.profile') }}" class="dropdown-item notify-item">
                    <i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
                    <span>Settings</span>
                </a>
                <div class="dropdown-divider"></div>

                <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                    <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-content">
        <!--- Sidemenu -->
        <div id="sidebar-menu" class="slimscroll-menu">
            <ul class="metismenu" id="menu-bar">
                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>


                 <li class="menu-title">Account Opening</li>


                     @if (auth()->user()->type == 'super-admin')

                      <li>
                        <a href="{{ route('account.partially-approved') }}">
                            <i data-feather="archive"></i>
                            <span> Partially Approved </span>
                        </a>
                    </li>


                   
                    <li>
                        <a href="{{ route('account.pending-accounts') }}">
                            <i data-feather="archive"></i>
                            <span> New Accounts </span>
                        </a>
                    </li>
                    @else

                    @endif
                      <li>
                        <a href="{{ route('account.completed-accounts') }}">
                            <i data-feather="calendar"></i>
                            <span> Approved Accounts </span>
                        </a>
                    </li>

                     <li class="menu-title">Loan Management</li>
                    @if (auth()->user()->type == 'super-admin')
                      <li>
                        <a href="{{ route('loan.partially') }}">
                            <i data-feather="archive"></i>
                            <span> Partially Approved </span>
                        </a>
                    </li>

                   
                     <li>
                        <a href="{{ route('loan.new') }}">
                            <i data-feather="book-open"></i>
                            <span> New Applications </span>
                        </a>
                    </li>
                    @else

                    @endif

                      <li>
                        <a href="{{ route('loan.active') }}">
                            <i data-feather="book"></i>
                            <span> Active Loans </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loan.paid') }}">
                            <i data-feather="book"></i>
                            <span> Paid Loans </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loan.rejected-loans') }}">
                            <i data-feather="x"></i>
                            <span> Rejected Loans </span>
                        </a>
                    </li>
            @if (auth()->user()->type == 'super-admin')


                    <li class="menu-title">System Users</li>

                    <li>
                        <a href="{{ route('users.index') }}">
                            <i data-feather="users"></i>
                            <span> Users </span>
                        </a>
                    </li>
            
                    <li class="menu-title">Relationship Managers</li>

                    <li>
                        <a href="{{ route('users.fetch-rms') }}">
                            <i data-feather="users"></i>
                            <span> List </span>
                        </a>
                    </li>
              
                    <li class="menu-title">System Configurations</li>

                    <li>
                        <a href="javascript: void(0);">
                            <i data-feather="sliders"></i>
                            <span> Configure </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{ route('roles.index') }}"> <i class="uil uil-briefcase"></i> Roles</a>
                            </li>
                            <li>
                                <a href="{{ route('permissions.index') }}"> <i class="uil uil-key-skeleton-alt"></i>
                                    Permissions</a>
                            </li>

                            <div class="dropdown-divider"></div>

                            <li>
                                <a href="{{ route('branch.index') }}"> <i class="uil uil-shop"></i> Branch</a>
                            </li>
                            <li>
                                <a href="{{ route('location.index') }}"> <i class="uil uil-map-pin-alt"></i> Location</a>
                            </li>
                        </ul>
                    </li>
            @else

            @endif



                <br><br>
                <li>
                    <a href="{{ route('logout') }}">
                        <i data-feather="power"></i>
                        <span> Logout </span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
