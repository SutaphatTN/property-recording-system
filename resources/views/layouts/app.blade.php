<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Property Recording System')</title>

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;500;700&display=swap" rel="stylesheet">


    <style>
        #mainContent {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        #contentArea {
            padding: 0 0.8rem;
        }

        body,
        input,
        select,
        textarea,
        button,
        table {
            font-family: 'Sarabun', sans-serif;
        }

        .custom-table {
            font-size: 1rem;
        }

        .custom-table td,
        .custom-table th {
            vertical-align: middle;
            font-size: 1rem;
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
        }

        .custom-table thead th {
            border-top: 1px solid #dee2e6;
        }

        @media (max-width: 1199.98px) {
            #layout-menu {
                display: none !important;
            }

            #mainContent {
                margin-left: 0 !important;
                width: 100% !important;
                padding-left: 0 !important;
            }
        }
    </style>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('layouts.sidebar')

            <div class="container-fluid" id="mainContent" style="transition: all 0.3s;">
                @include('layouts.navbar')

                <div id="contentArea" class="mb-4">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>

    <div id="containerStoreMain"></div>
    <div id="containerStoreGeneralMain"></div>
    <div id="containerStore"></div>
    <div id="containerStoreAsset"></div>
    <div id="containerPrintAll"></div>
    <div id="containerExcel"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="assets/vendor/js/helpers.js"></script>

    <script>
        $(document).ready(function() {

            function setActiveMenu(selector) {
                $('.menu-item').removeClass('active');

                var $submenuItem = $(selector).closest('.menu-item');
                $submenuItem.addClass('active');

                var $parent = $(selector).closest('.menu-item').parent().closest('.menu-item');
                if ($parent.length) {
                    $parent.addClass('active');
                }
            }

            function loadContent(url, callback) {
                $.get(url, function(html) {
                    $('#contentArea').html(html);
                    if (typeof callback === "function") callback();
                });
            }

            $(document).on('click', '.btnIndex', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                setActiveMenu(this);
                loadContent(url, initAssetTable);
            });

            $(document).on('click', '.btnMainIndex', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                setActiveMenu(this);
                loadContent(url, initMainTable);
            });

            $(document).on('click', '.btnViewAudit', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                setActiveMenu(this);
                loadContent(url, initMainAuditTable);
            });

            $(document).on('click', '.btnViewApproval', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                setActiveMenu(this);
                loadContent(url, initMainApproveTable);
            });

            $(document).on('click', '.btnViewResultApproval', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                setActiveMenu(this);
                loadContent(url, initMainResultTable);
            });

            $(document).on('click', '.btnOpenReportMoney', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                setActiveMenu(this);
                loadContent(url);
            });

        });
    </script>

    <script src="{{ asset('js/assetData.js') }}"></script>
    <script src="{{ asset('js/maintenance.js') }}"></script>

</body>

</html>