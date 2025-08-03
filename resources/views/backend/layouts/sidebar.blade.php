<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <div class="demo justify-content-center align-items-center">
            <img style="width: 180px" class="img-fluid" src="{{ asset('backend/assets/img/logo_big.png') }}"
                alt="{{ config('settings.APP_NAME') }}" />
        </div>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-dashboard"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.adminList', 'admin.addAdmin', 'admin.editAdmin') ? 'active' : '' }}">
            <a href="{{ route('admin.adminList') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div data-i18n="Manage Admins">Manage Admins</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.skillList', 'admin.addSkill', 'admin.editSkill') ? 'active' : '' }}">
            <a href="{{ route('admin.skillList') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-list"></i>
                <div data-i18n="Manage Skills">Manage Skills</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.experienceList', 'admin.addExperience', 'admin.editExperience') ? 'active' : '' }}">
            <a href="{{ route('admin.experienceList') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-list"></i>
                <div data-i18n="Manage Expericence">Manage Expericences</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.serviceList', 'admin.addService', 'admin.editService') ? 'active' : '' }}">
            <a href="{{ route('admin.serviceList') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-list"></i>
                <div data-i18n="Manage Services">Manage Services</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.projectList', 'admin.addProject', 'admin.editProject') ? 'active' : '' }}">
            <a href="{{ route('admin.projectList') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-list"></i>
                <div data-i18n="Manage Project">Manage Project</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('logout') ? 'active' : '' }}">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                class="menu-link">
                <i class="menu-icon tf-icons ti ti-logout"></i>
                <div data-i18n="Logout">Logout</div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
    @include('backend.layouts.footer');
</aside>
