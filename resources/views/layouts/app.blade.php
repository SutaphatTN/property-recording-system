<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .navbar .nav-link {
            color: white !important;
        }

        @media (max-width: 576px) {
            .header-text-button {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .header-text-button h2 {
                margin: 0;
                font-size: 1.2rem;
            }

            .header-text-button button {
                width: 100%;
                max-width: 250px;
            }
        }

        .dropdown-item:hover {
            background-color: #007bff;
            color: white;
        }

        /* .dropdown-menu .dropend:hover>.dropdown-menu {
            display: block;
            position: absolute;
            top: 0;
            left: 101%;
            margin-top: 0;
            margin-left: 0;
        } */
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-black shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white d-flex align-items-center"
                    href="@auth {{ route('assetData.index') }} @else {{ url('/') }} @endauth">
                    <img src="{{ asset('images/Mitsubishi_logo.png') }}" alt="Logo"
                        class="img-fluid" style="height: 20px; width: auto; margin-right: 5px; margin-bottom: 3px;">
                    <span class="d-none d-sm-inline">ระบบแจ้งซ่อม</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                เพิ่มข้อมูลทรัพย์สิน
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item btnOpenStoreModal" href="#">
                                    ทรัพย์สินที่มีอยู่
                                </a>

                                <a class="dropdown-item btnOpenStoreAssetModal" href="#">
                                    ทรัพย์สินใหม่
                                </a>

                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link btnIndex" href="{{ route('assetData.index') }}">ข้อมูลทรัพย์สิน</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                แจ้งซ่อม
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item btnOpenStoreMainModal" href="#">
                                    แจ้งซ่อมทรัพย์สิน
                                </a>

                                <a class="dropdown-item btnOpenStoreGeneralMainModal" href="#">
                                    แจ้งซ่อมทั่วไป
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                ระบบข้อมูลแจ้งซ่อม
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item btnMainIndex" href="{{ route('maintenance.index') }}">
                                    ข้อมูลแจ้งซ่อม
                                </a>

                                <a class="dropdown-item btnViewAudit" href="{{ route('maintenance.viewAudit') }}">
                                    รอตรวจสอบ
                                </a>

                                <a class="dropdown-item btnViewApproval" href="{{ route('maintenance.viewApproval') }}">
                                    รออนุมัติ
                                </a>

                                <a class="dropdown-item btnViewResultApproval" href="{{ route('maintenance.viewResultApproval') }}">
                                    ผลการอนุมัติ
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                รายงาน
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item btnOpenExcel" href="#">
                                    ข้อมูลทรัพย์สินประจำเดือน
                                </a>

                                <a class="dropdown-item btnOpenReportMoney" href="{{ route('assetData.reportMoney') }}">
                                    รายงานการใช้งบประมาณ
                                </a>

                                <a class="dropdown-item btnOpenPrintAll" href="#">
                                    ปริ้น Qr Code
                                </a>
                            </div>
                        </li>
                    </ul>
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('ออกจากระบบ') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div id="containerStoreMain"></div>
        <div id="containerStoreGeneralMain"></div>
        <div id="containerStore"></div>
        <div id="containerStoreAsset"></div>
        <div id="containerPrintAll"></div>
        <div id="containerExcel"></div>

        <div class="container-fluid p-4" id="contentArea">
            @yield('content')
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btnIndex', function(e) {
                e.preventDefault();

                $.get("{{ route('assetData.index') }}", function(html) {
                    let newContent = $(html).find('#contentArea').html();
                    $('#contentArea').html(newContent);
                    initAssetTable();
                });
            });

            $(document).on('click', '.btnMainIndex', function(e) {
                e.preventDefault();

                $.get("{{ route('maintenance.index') }}", function(html) {
                    let newContent = $(html).find('#contentArea').html();
                    $('#contentArea').html(newContent);
                    initMainTable();
                });
            });

            $(document).on('click', '.btnViewAudit', function(e) {
                e.preventDefault();

                $.get("{{ route('maintenance.viewAudit') }}", function(html) {
                    let newContent = $(html).find('#contentArea').html();
                    $('#contentArea').html(newContent);
                    initMainAuditTable();
                });
            });

            $(document).on('click', '.btnViewApproval', function(e) {
                e.preventDefault();

                $.get("{{ route('maintenance.viewApproval') }}", function(html) {
                    let newContent = $(html).find('#contentArea').html();
                    $('#contentArea').html(newContent);
                    initMainApproveTable();
                });
            });

            $(document).on('click', '.btnViewResultApproval', function(e) {
                e.preventDefault();

                $.get("{{ route('maintenance.viewResultApproval') }}", function(html) {
                    let newContent = $(html).find('#contentArea').html();
                    $('#contentArea').html(newContent);
                    initMainResultTable();
                });
            });

            $(document).on('click', '.btnOpenReportMoney', function(e) {
                e.preventDefault();

                $.get("{{ route('assetData.reportMoney') }}", function(html) {
                    let newContent = $(html).find('#contentArea').html();
                    $('#contentArea').html(newContent);
                });
            });

        });
    </script>
    <script src="{{ asset('js/assetData.js') }}"></script>
    <script src="{{ asset('js/maintenance.js') }}"></script>
</body>

</html>