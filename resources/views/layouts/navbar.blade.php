<nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme">
    <div class="d-flex align-items-center">
        <button id="sidebarToggle" class="btn btn-icon">
            <i class="bx bx-menu" style='font-size: 26px;'></i>
        </button>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                    <span class="me-2">{{ Auth::user()->name }}</span>
                    <span class="avatar avatar-online" style="width: 10px; height: 10px;"></span>
                </a>


                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">ออกจากระบบ</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<style>
    .navbar-nav .avatar-online {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        vertical-align: middle;
    }

    .nav-link span.me-2 {
        margin-right: 0.5rem;
    }
</style>