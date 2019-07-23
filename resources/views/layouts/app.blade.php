<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Sofra</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{asset('adminlte/blugins/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('adminlte/blugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
<link rel="stylesheet" href="{{asset('adminlte/blugins/Ionicons/css/ionicons.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('adminlte/css/skins/_all-skins.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

 @if(app()->getLocale()=='ar')
 <link rel="stylesheet" href="{{ url('adminlte/css/rtl/AdminLTE.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte/css/rtl/bootstrap-rtl.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte/css/rtl/rtl.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=cairo:600,700">
   
     @else
     
     <link rel="stylesheet" href="{{asset('adminlte/css/AdminLTE.min.css')}}">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   
  @endif

</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>SR</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sofra</b> </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      
         
        
    
 
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
              </a>
              <ul class="dropdown-menu">
                  <ul class="menu">
                      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                      <li>
                          <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                              {{ $properties['native'] }}
                          </a>
                      </li>
                  @endforeach
                  
                  </ul>
               
              </ul>
            </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">@if(auth()->check()) {{ auth()->user()->name }} @endif</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
 
                <p>
                  
                  <small>Member since @if(auth()->check()) {{ auth()->user()->name }} @endif</small>
                </p>
              </li>
 
              <!-- Menu Footer-->
              <li class="user-footer">
 
                <div class="text-center">
                    <form action="{{ url('logout') }}" method="post" id='signoutForm'>
                        @csrf
 
                            <script type="">
                            function submitSignout() {
                                document.getElementById('signoutForm').submit();
 
                            }
                        </script>
                        {{-- {!! Form::open(['method' => 'post', 'url' => url('logout'),'id'=>'signoutForm']) !!}
 
                        {!! Form::close() !!} --}}
 
                    </form>
                        <a href="#" onclick="submitSignout()">
                                <i class="fa fa-sign-out"></i> log out 
                            </a>
 
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>@if(auth()->check()) {{ auth()->user()->name }} @endif </p> 
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
       
        <li>
          <a href="{{url(route('home'))}}">
            <i class="fa fa-th"></i> <span>Home</span>
          </a>
        </li>
          <li>
              <a href="{{url(route('clients.index'))}}">
                <i class="fa fa-th"></i> <span>Clients</span>
              </a>
            </li>
           
            <li>
                <a href="{{url(route('region.index'))}}">
                  <i class="fa fa-th"></i> <span>Regions</span>
                </a>
              </li>
          <li>
              <a href="{{url(route('contact.index'))}}">
                <i class="fa fa-th"></i> <span>Contacts</span>
              </a>
            </li>
            <li>
                <a href="{{url(route('setting.index'))}}">
                  <i class="fa fa-th"></i> <span>Settings</span>
                </a>
              </li>
              <li>
                  <a href="{{url(route('category.index'))}}">
                    <i class="fa fa-th"></i> <span>Categories</span>
                  </a>
                </li>
                <li>
                    <a href="{{url(route('city.index'))}}">
                      <i class="fa fa-th"></i> <span>Cities</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{url(route('offers.index'))}}">
                      <i class="fa fa-th"></i> <span>Offers</span>
                    </a>
                  </li>
                  <li>
                      <li>
                          <a href="{{url(route('order.index'))}}">
                            <i class="fa fa-th"></i> <span>Orders</span>
                          </a>
                        </li>
                        <li>
                            <li>
                                <a href="{{url(route('resturants.index'))}}">
                                  <i class="fa fa-th"></i> <span>Resturants</span>
                                </a>
                              </li>
                              <li>
                                  <li>
                                      <a href="{{url(route('products.index'))}}">
                                        <i class="fa fa-th"></i> <span>Product</span>
                                      </a>
                                    </li>
                                    <li> 
                                        <a href="{{url('payment')}}">
                                            <i class="fa fa-th"></i> <span>Payment</span>
                                          </a>
                                        </li> 
                                    <li>
                                        <li> 
                                            <a href="{{url('role')}}">
                                                <i class="fa fa-th"></i> <span>Role</span>
                                              </a>
                                            </li> 
                                        <li>
                                            <li>
                                                <a href="{{url(route('user.index'))}}">
                                                  <i class="fa fa-th"></i> <span>Users</span>
                                                </a>
                                              </li>
                                              <li>
                    <a href="{{url('resetpassword')}}">
                      <i class="fa fa-th"></i> <span>Resetpassword</span>
                    </a>
                  </li>  

                
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @yield('content')
    
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
   
    <strong>Copyright &copy; 2019-2020 . Ahmed Elmatbouly .</strong> All rights
    reserved.
  </footer>

 
  
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('adminlte/blugins/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/blugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte/blugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/blugins/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/js/demo.js')}}"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
@stack('scripts')
</body>
</html>
