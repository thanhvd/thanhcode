<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{url('/')}}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ThanhCode - @yield('title')</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="AdminLTE-2.3.6/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="AdminLTE-2.3.6/plugins/daterangepicker/daterangepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="AdminLTE-2.3.6/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="AdminLTE-2.3.6/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="AdminLTE-2.3.6/dist/css/skins/skin-blue.min.css">
    <!-- Easy UI -->
    <link rel="stylesheet" type="text/css" href="jquery-easyui-1.5/themes/material/easyui.css">
    <link rel="stylesheet" type="text/css" href="jquery-easyui-1.5/themes/icon.css">

    <!-- My Style -->
    <link rel="stylesheet" type="text/css" href="assets/css/app.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.2.3 -->
    <script src="AdminLTE-2.3.6/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="AdminLTE-2.3.6/bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="AdminLTE-2.3.6/plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="AdminLTE-2.3.6/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="AdminLTE-2.3.6/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="AdminLTE-2.3.6/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="AdminLTE-2.3.6/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- SlimScroll -->
    <script src="AdminLTE-2.3.6/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="AdminLTE-2.3.6/plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="AdminLTE-2.3.6/dist/js/app.min.js"></script>
    <!-- Easy UI -->
    <script type="text/javascript" src="jquery-easyui-1.5/jquery.easyui.min.js"></script>

    @yield('page_script')

</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

    <!-- Main Header -->
    @include('layouts._partials.header')
    <!-- Left side column. contains the logo and sidebar -->
    @include('layouts._partials.main_sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('layouts._partials.content_header')

      <!-- Main content -->
      <section class="content">
        @yield('content')
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('layouts._partials.footer')
    <!-- Control Sidebar -->
    @include('layouts._partials.control_sidebar')
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
</body>
</html>
