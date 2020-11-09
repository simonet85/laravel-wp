
<!DOCTYPE html>
<html>
<head>
 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title','MY BLOG')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/backend/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('assets/backend/css/skins/_all-skins.min.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
  <script src="{{url('https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js')}}"></script>
  <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css')}}" />

  <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/backend/css/custom.css')}}">
  
  @notify_css

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header">
    <!-- Logo -->
    <a href="{{url('/')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>MY</b>BLOG</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a> -->

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <?php $currentUser = Auth::user();?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{$currentUser->gravatar()}}" class="user-image" alt="{{$currentUser->name}}">
              <span class="hidden-xs">{{$currentUser->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{$currentUser->gravatar()}}" class="img-circle" alt="User Image">

                <p>
                  {{$currentUser->name}} - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                <a href="{{route('accounts.edit', ['account'=>$currentUser->id])}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                <a href="{{ route('logout')}}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('form-logout').submit(); ">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
        <form action="{{route('logout')}}" method="POST" id="form-logout">
            @csrf
        </form>
      </div>
    </nav>
  </header>