<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>@yield('title')</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/assets/img/brand/favicon.png')}}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('assets/assets/css/argon.css?v=1.2.0')}}" type="text/css">
  @yield('css')
</head>

<body>
  <!-- Sidenav -->
  
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <div class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
              <h2 class="text-white">Transaksi</h2>
          </div>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            
          </ul>

          {{-- profile --}}
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="media align-items-center">
                  <div class="media-body  ml-2  d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                  </div>
                </div>
              </a>

              <div class="dropdown-menu  dropdown-menu-right ">
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" 
                   class="dropdown-item"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
              </div>

            </li>
          </ul>      
        </div>
      </div>
    </nav>

      @yield('content')
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('assets/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/assets/vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{ asset('assets/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{ asset('assets/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  
  <!-- Argon JS -->
  <script src="{{ asset('assets/assets/js/argon.js?v=1.2.0')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  @if (session('success'))
      <script>
        Swal.fire(
          'Sukses!',
           '{{ session('success') }}',
          'success'
        )
      </script>
  @endif
  @if (session('error'))
      <script>
        Swal.fire(
          'Gagal!',
          '{{ session('error') }}',
          'error'
        )
      </script>
  @endif
  @yield('js')
</body>

</html>