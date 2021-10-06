<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
@include('shared.header')

@yield('stylesheets')
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
<div class="wrapper" id="app">

  <!-- Navbar -->
  @include('shared.topbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('shared.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content -->
        @yield('content')
    <!-- /.content -->
        <div class="modal fade" id="global-modal"></div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('shared.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('admin-assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin-assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
@include('sweetalert::alert')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- Select2 -->
<script src="{{ asset('admin-assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    var Toast;
  $(function () {
    Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        showCloseButton: true,
    })
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    })
    //tagInputs
    $(".vendor-chalan-tag").select2({
        tags: true,
        theme: 'bootstrap4',
        tokenSeparators: [',', ';'],
        placeholder: 'Vendor\'s chalan number',
        allowClear: true
    })
    //tagInputs
    $(".input-tags").select2({
        tags: true,
        theme: 'bootstrap4',
        tokenSeparators: [',', ';'],
        placeholder: 'Enter Tags',
        allowClear: true
    })
  });
</script>
@yield('javascripts')
</body>
</html>
