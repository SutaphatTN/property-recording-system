
$(document).ready(function () {
    $(document).on('click', '.btnIndex', function (e) {
        e.preventDefault();

        $.get("{{ route('assetData.index') }}", function (html) {
            $('#contentArea').html(html);
            initAssetTable();
        });
    });

    $(document).on('click', '.btnMainIndex', function (e) {
        e.preventDefault();

        $.get("{{ route('maintenance.index') }}", function (html) {
            $('#contentArea').html(html);
            initMainTable();
        });
    });

    $(document).on('click', '.btnViewAudit', function (e) {
        e.preventDefault();

        $.get("{{ route('maintenance.viewAudit') }}", function (html) {
            $('#contentArea').html(html);
            initMainAuditTable();
        });
    });

    $(document).on('click', '.btnViewApproval', function (e) {
        e.preventDefault();

        $.get("{{ route('maintenance.viewApproval') }}", function (html) {
            $('#contentArea').html(html);
            initMainApproveTable();
        });
    });

    $(document).on('click', '.btnViewResultApproval', function (e) {
        e.preventDefault();

        $.get("{{ route('maintenance.viewResultApproval') }}", function (html) {
            $('#contentArea').html(html);
            initMainResultTable();
        });
    });

    $(document).on('click', '.btnOpenReportMoney', function (e) {
        e.preventDefault();

        $.get("{{ route('assetData.reportMoney') }}", function (html) {
            $('#contentArea').html(html);
        });
    });
});

const sidebar = document.getElementById('layout-menu');
const mainContent = document.getElementById('mainContent');
const toggleBtn = document.getElementById('sidebarToggle');

if(toggleBtn){ 
    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
        mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '0' : '250px';
    });
}
