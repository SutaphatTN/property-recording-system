<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a class="app-brand-link" href="{{ route('home') }}">
      <img src="{{ asset('assets/img/Mitsubishi_logoCrop.png') }}" width="40" class="me-2">
      <span class="fw-bold">ระบบแจ้งซ่อม</span>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <li class="menu-item">
      <a class="menu-link btnIndex" href="{{ route('assetData.index') }}">
        <i class="menu-icon tf-icons bx bxs-box"></i>
        ข้อมูลทรัพย์สิน
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-plus"></i>
        <div class="text-truncate">{{ __('เพิ่มข้อมูลทรัพย์สิน') }}</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a class="menu-link btnOpenStoreModal" href="#" wire:navigate>{{ __('ทรัพย์สินที่มีอยู่') }}</a>
        </li>
        <li class="menu-item">
          <a class="menu-link btnOpenStoreAssetModal" href="#" wire:navigate>{{ __('ทรัพย์สินใหม่') }}</a>
        </li>
      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-wrench"></i>
        <div class="text-truncate">{{ __('แจ้งซ่อม') }}</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a class="menu-link btnOpenStoreMainModal" href="#" wire:navigate>{{ __('แจ้งซ่อมทรัพย์สิน') }}</a>
        </li>
        <li class="menu-item">
          <a class="menu-link btnOpenStoreGeneralMainModal" href="#" wire:navigate>{{ __('แจ้งซ่อมทั่วไป') }}</a>
        </li>
      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-package"></i>
        <div class="text-truncate">{{ __('ระบบข้อมูลแจ้งซ่อม') }}</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a class="menu-link btnMainIndex" href="{{ route('maintenance.index') }}">{{ __('ข้อมูลแจ้งซ่อม') }}</a>
        </li>
        <li class="menu-item">
          <a class="menu-link btnViewAudit" href="{{ route('maintenance.viewAudit') }}">{{ __('รอตรวจสอบ') }}</a>
        </li>
        <li class="menu-item">
          <a class="menu-link btnViewApproval" href="{{ route('maintenance.viewApproval') }}">{{ __('รออนุมัติ') }}</a>
        </li>
        <li class="menu-item">
          <a class="menu-link btnViewResultApproval" href="{{ route('maintenance.viewResultApproval') }}">{{ __('ผลการอนุมัติ') }}</a>
        </li>
      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-report"></i>
        <div class="text-truncate">{{ __('รายงาน') }}</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a class="menu-link btnOpenExcel" href="#">{{ __('ข้อมูลทรัพย์สินประจำเดือน') }}</a>
        </li>
        <li class="menu-item">
          <a class="menu-link btnOpenReportMoney" href="{{ route('assetData.reportMoney') }}">{{ __('รายงานการใช้งบประมาณ') }}</a>
        </li>
        <li class="menu-item">
          <a class="menu-link btnOpenPrintAll" href="#">{{ __('ปริ้น Qr Code') }}</a>
        </li>
      </ul>
    </li>
  </ul>
</aside>

<style>
  #layout-menu {
    width: 280px;
    height: 100vh;
    overflow-y: auto;
    padding: 1rem;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
  }

  #layout-menu.collapsed {
    width: 0;
    padding: 0 !important;
    opacity: 0;
  }

  #layout-menu ul li a {
    color: #000;
  }

  #layout-menu ul li a:hover {
    background-color: #f1f1f1;
  }

  #mainContent {
    margin-left: 280px;
    transition: margin-left 0.3s ease;
  }

  .app-brand-link .fw-bold {
    font-size: 1.3rem;
    color: #313131ff !important;
  }

  .menu-inner .menu-item {
    margin-bottom: 0.25rem;
  }

  .menu-link {
    display: flex;
    align-items: center;
    padding: 0.6rem 1rem;
    border-radius: 0.5rem;
    transition: background 0.3s ease, color 0.3s ease;
    gap: 0.5rem;
    color: #333333 !important;
    font-size: 1rem !important;
  }

  .menu-link:hover {
    background-color: #5848c2;
    color: #fff;
  }

  .menu-link .menu-icon {
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    transition: transform 0.3s ease, color 0.3s ease;
    color: #575757ff;
  }

  .menu-sub .menu-link .menu-icon {
    font-size: 1.3rem;
  }

  .menu-sub {
    display: none;
    padding-left: 1rem;
  }

  .menu-sub .menu-link {
    padding: 0.5rem 1rem;
    color: #333333;
    background-color: rgba(255, 255, 255, 0.05);
    border-radius: 0.4rem;
  }

  .menu-item.active>.menu-link,
  .menu-item.open>.menu-link,
  .menu-sub .menu-item.active>.menu-link,
  .menu-item.active>.menu-link .menu-icon,
  .menu-item.open>.menu-link .menu-icon,
  .menu-sub .menu-item.active>.menu-link .menu-icon {
    color: #6c5ffc;
  }

  .menu-item.active>.menu-link,
  .menu-item.active>.menu-link .text-truncate,
  .menu-item.open>.menu-link,
  .menu-item.open>.menu-link .text-truncate,
  .menu-sub .menu-item.active>.menu-link,
  .menu-sub .menu-item.active>.menu-link .text-truncate {
    color: #6c5ffc !important;
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).on('click', '.menu-toggle', function(e) {
    e.preventDefault();

    var $menuItem = $(this).closest('.menu-item');
    var $submenu = $menuItem.children('.menu-sub');

    if ($menuItem.hasClass('open')) {
      $submenu.stop(true, true).slideUp(200);
      $menuItem.removeClass('open');
    } else {
      $submenu.stop(true, true).slideDown(200);
      $menuItem.addClass('open');
    }
  });

  document.addEventListener('DOMContentLoaded', function() {

    const sidebar = document.getElementById('layout-menu');
    const mainContent = document.getElementById('mainContent');
    const toggleBtn = document.getElementById('sidebarToggle');

    if (toggleBtn) {
      toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '0' : '250px';
      });
    }

    document.querySelectorAll('.menu-item > .menu-link.dropdown-toggle').forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const parent = link.parentElement;
        parent.classList.toggle('open');
      });
    });
  });
</script>