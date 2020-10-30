 @include('layouts.admin-header')
  <!-- Left side column. contains the logo and sidebar -->
  @include('layouts.admin-sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
      <h1>
        Dasbhboard
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        <li ><i class="fa fa-chevron"></i> Blog</li>
        <li ><i class="fa fa-chevron"></i> All Posts</li>
      </ol>
     
    </section> --}}

    @yield('admin-content')

  </div>
  <!-- /.content-wrapper -->
  @include('layouts.admin-footer')
  @yield('scripts')
