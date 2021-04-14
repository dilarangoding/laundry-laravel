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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
  
  @yield('css')
</head>

<body>
  <!-- Sidenav -->
    @include('layouts.sidebar')
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
      @include('layouts.navbar')

      @yield('content')
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('assets/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('assets/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/assets/vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{ asset('assets/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{ asset('assets/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <!-- Optional JS -->
  <!-- Argon JS -->
  <script src="{{ asset('assets/assets/js/argon.js?v=1.2.0')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
        $(document).ready(function() {
          $('.table-flush').DataTable( {
      
              "paging": false,
              "info"  : false,
          } );
      } );

  </script>
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