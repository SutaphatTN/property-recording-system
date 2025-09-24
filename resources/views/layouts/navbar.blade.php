<nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme">
    <div class="d-flex align-items-center">
        <button id="sidebarToggle" class="btn btn-icon d-none d-xl-inline-block">
            <i class="bx bx-menu" style='font-size: 26px;'></i>
        </button>
    </div>

    <div class="navbar-nav-left d-flex align-items-center">
        <ul class="navbar-nav flex-row align-items-center ms-auto d-none d-sm-flex d-xl-none">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="menu-icon tf-icons bx bxs-home"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btnIndex" href="{{ route('assetData.index') }}">
                    ข้อมูลทรัพย์สิน
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link btnOpenStoreAssetModal" href="#">
                    เพิ่มข้อมูลทรัพย์สิน
                </a>
            </li>

            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="assetStoreMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    เพิ่มข้อมูลทรัพย์สิน
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="assetStoreMenu">
                    <li><a class="dropdown-item btnOpenStoreModal" href="#">ทรัพย์สินที่มีอยู่</a></li>
                    <li><a class="dropdown-item btnOpenStoreAssetModal" href="#">ทรัพย์สินใหม่</a></li>
                </ul>
            </li> -->

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="mainStoreMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    แจ้งซ่อม
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mainStoreMenu">
                    <li><a class="dropdown-item btnOpenStoreMainModal" href="#">แจ้งซ่อมทรัพย์สิน</a></li>
                    <li><a class="dropdown-item btnOpenStoreGeneralMainModal" href="#">แจ้งซ่อมทั่วไป</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="mainMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ระบบข้อมูลแจ้งซ่อม
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mainMenu">
                    <li><a class="dropdown-item btnMainIndex" href="{{ route('maintenance.index') }}">ข้อมูลแจ้งซ่อม</a></li>
                    <li><a class="dropdown-item btnViewAudit" href="{{ route('maintenance.viewAudit') }}">รอตรวจสอบ</a></li>
                    <li><a class="dropdown-item btnViewApproval" href="{{ route('maintenance.viewApproval') }}">รออนุมัติ</a></li>
                    <li><a class="dropdown-item btnViewResultApproval" href="{{ route('maintenance.viewResultApproval') }}">ผลการอนุมัติ</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="report" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    รายงาน
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="report">
                    <li><a class="dropdown-item btnOpenExcel" href="#">ข้อมูลทรัพย์สินประจำเดือน</a></li>
                    <li><a class="dropdown-item btnOpenReportMoney" href="{{ route('assetData.reportMoney') }}">รายงานการใช้งบประมาณ</a></li>
                    <li><a class="dropdown-item btnOpenPrintAll" href="#">ปริ้น Qr Code</a></li>
                </ul>
            </li>
        </ul>

        <ul class="navbar-nav flex-row align-items-center ms-auto d-flex d-sm-none">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="menu-icon tf-icons bx bx-menu"></i></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item dropdown-item-mobile" href="{{ route('home') }}"><i class="menu-icon tf-icons bx bxs-home menu-icon-mobile"></i> หน้าแรก</a></li>
                    <li><a class="dropdown-item dropdown-item-mobile btnIndex" href="{{ route('assetData.index') }}"><i class="menu-icon tf-icons bx bxs-box menu-icon-mobile"></i> ข้อมูลทรัพย์สิน</a></li>
                    <li><a class="dropdown-item dropdown-item-mobile btnOpenStoreAssetModal" href="#"><i class="menu-icon tf-icons bx bx-plus menu-icon-mobile"></i> เพิ่มข้อมูลทรัพย์สิน</a></li>

                    <li class="nav-item">
                        <span class="dropdown-item nav-span dropdown-item-mobile"><i class="menu-icon tf-icons bx bx-wrench menu-icon-mobile"></i> แจ้งซ่อม</span>
                        <ul class="list-unstyled">
                            <li><a class="dropdown-item dropdown-item-mobile btnOpenStoreMainModal" href="#"><i class="menu-icon tf-icons bx bx-chevron-right menu-icon-mobile"></i>แจ้งซ่อมทรัพย์สิน</a></li>
                            <li><a class="dropdown-item dropdown-item-mobile btnOpenStoreGeneralMainModal" href="#"><i class="menu-icon tf-icons bx bx-chevron-right menu-icon-mobile"></i>แจ้งซ่อมทั่วไป</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <span class="dropdown-item nav-span dropdown-item-mobile"><i class="menu-icon tf-icons bx bx-package menu-icon-mobile"></i> ระบบข้อมูลแจ้งซ่อม</span>
                        <ul class="list-unstyled">
                            <li><a class="dropdown-item dropdown-item-mobile btnMainIndex" href="{{ route('maintenance.index') }}"><i class="menu-icon tf-icons bx bx-chevron-right menu-icon-mobile"></i>ข้อมูลแจ้งซ่อม</a></li>
                            <li><a class="dropdown-item dropdown-item-mobile btnViewAudit" href="{{ route('maintenance.viewAudit') }}"><i class="menu-icon tf-icons bx bx-chevron-right menu-icon-mobile"></i>รอตรวจสอบ</a></li>
                            <li><a class="dropdown-item dropdown-item-mobile btnViewApproval" href="{{ route('maintenance.viewApproval') }}"><i class="menu-icon tf-icons bx bx-chevron-right menu-icon-mobile"></i>รออนุมัติ</a></li>
                            <li><a class="dropdown-item dropdown-item-mobile btnViewResultApproval" href="{{ route('maintenance.viewResultApproval') }}"><i class="menu-icon tf-icons bx bx-chevron-right menu-icon-mobile"></i>ผลการอนุมัติ</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <span class="dropdown-item nav-span dropdown-item-mobile"><i class="menu-icon tf-icons bx bxs-report menu-icon-mobile"></i> รายงาน</span>
                        <ul class="list-unstyled">
                            <li><a class="dropdown-item dropdown-item-mobile btnOpenExcel" href="#"><i class="menu-icon tf-icons bx bx-chevron-right menu-icon-mobile"></i>ข้อมูลทรัพย์สินประจำเดือน</a></li>
                            <li><a class="dropdown-item dropdown-item-mobile btnOpenReportMoney" href="{{ route('assetData.reportMoney') }}"><i class="menu-icon tf-icons bx bx-chevron-right menu-icon-mobile"></i>รายงานการใช้งบประมาณ</a></li>
                            <li><a class="dropdown-item dropdown-item-mobile btnOpenPrintAll" href="#"><i class="menu-icon tf-icons bx bx-chevron-right menu-icon-mobile"></i>ปริ้น Qr Code</a></li>
                        </ul>
                    </li>

                </ul>
            </li>
        </ul>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                @auth
                <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                    <span class="me-2">{{ Auth::user()->name }}</span>
                    <span class="avatar avatar-online" style="width: 10px; height: 10px;"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    @if(Auth::user()->role == 'audit')
                    <li>
                        <a class="dropdown-item" href="{{ route('register.view') }}">
                            <i class="bx bx-id-card me-2 align-middle"></i>
                            <span class="align-middle">ลงทะเบียน</span>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item btnUserIndex" href="{{ route('user.index') }}">
                            <i class="bx bx-user me-2 align-middle"></i>
                            <span class="align-middle">รายชื่อผู้ใช้งาน</span>
                        </a>
                    </li>
                    @endif

                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2 align-middle"></i>
                            <span class="align-middle">ออกจากระบบ</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
                @endauth
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

    @media (max-width: 1199.98px) {
        #sidebarToggle {
            display: none !important;
        }
    }

    .navbar-nav-left .nav-item .nav-link {
        white-space: nowrap;
        margin-right: 0.5rem;
    }

    .navbar-nav-left .dropdown-toggle::after {
        margin-left: 0.25rem;
    }

    .navbar-nav-left .dropdown-menu {
        min-width: 180px;
    }

    .nav-span {
        padding-left: 1.3rem;
    }

    .navbar-nav-left .list-unstyled {
        padding-left: 2rem;

    }

    .dropdown-menu .dropdown-item-mobile {
        padding-top: 0.30rem;
        padding-bottom: 0.30rem;
        line-height: 1.5;
    }

    .dropdown-menu .menu-icon-mobile {
        font-size: 18px;
        margin-right: 0.4rem;
        vertical-align: middle;
    }

    @media (max-width: 576px) {
        .navbar-nav .dropdown-toggle::after {
            display: none !important;
        }
    }
</style>