<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-sticky navbar-dark navbar-without-dd-arrow" role="navigation" data-menu="menu-wrapper">
    <div class="navbar-header d-xl-none d-block">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html">
                    <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/logo.png" /></div>
                    <h2 class="brand-text mb-0">Frest</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <!-- include ../../../includes/mixins-->
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            @can('show_roles')
            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="{{ route('roles') }}" data-toggle="dropdown"><i class="menu-livicon" data-icon="lock"></i><span data-i18n="Dashboard">{{ transWord('Roles') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ menuActive('roles',3) }}"><a class="dropdown-item align-items-center" href="{{ route('roles') }}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>{{ transWord('Roles') }}</a></li>
                </ul>
            </li>
            @endcan

            @can('show_users')
            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="{{ route('users') }}" data-toggle="dropdown"><i class="menu-livicon" data-icon="users"></i><span data-i18n="Dashboard">{{ transWord('Accounts') }}</span></a>
                <ul class="dropdown-menu">
                    @can('create_users')
                        <li class="{{ menuActive('users',3) }}"><a class="dropdown-item align-items-center" href="{{ route('users') }}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>{{ transWord('New Account') }}</a></li>
                    @endcan

                    @can('show_users')
                        <li class="{{ menuActive('users',3) }}"><a class="dropdown-item align-items-center" href="{{ route('create_users') }}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>{{ transWord('Accounts') }}</a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>