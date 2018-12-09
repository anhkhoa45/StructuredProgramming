<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  @section('style')
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins	
       folder instead of downloading all of them to reduce the load. -->	
  <link rel="stylesheet" href="/adminlte/dist/css/skins/_all-skins.min.css">
    @show


</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
      @include('admin/layouts/__header')
      <!-- BEGIN SIDEBAR -->
      @include('admin/layouts/__sidebar')
      @include('admin/layouts/__rightbar')
      <div class="content-wrapper" id="page-content">
          @yield('content')   
      </div> <!-- page-content -->
      @include('admin/layouts/__footer')

      @section('script')
      <!-- jQuery 3 -->
          <script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
          <!-- jQuery UI 1.11.4 -->
          <script src="/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>
          <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
          <script>
              $.widget.bridge('uibutton', $.ui.button);
          </script>
          <!-- Bootstrap 3.3.7 -->
          <script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
          <!-- AdminLTE App -->
          <script src="/adminlte/dist/js/adminlte.min.js"></script>
          <!-- Chart js -->
          <script src="/adminlte/bower_components/chart.js/Chart.js"></script>

          <script>
              $(document).ready(function(){
                  $('a.delete').click(function(){
                      var confirm = window.confirm('Are you sure?');
                      if(confirm)
                          $(this).parent().find('.form-destroy').submit();
                  });
              });
          </script>
      @show
  </div> <!-- wrapper -->
</body>
</html>
