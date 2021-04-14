<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
           
            <h1 style="color:#6772e5;"><i class="ni ni-basket"></i> Laundry.in</h1>
          {{-- <img src="{{ asset('assets/assets/img/brand/blue.png')}}" class="navbar-brand-img" alt="..."> --}}
        </a>
      </div>
      <hr class="my-1">
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            
            <li class="nav-item">
              <a class="nav-link " href="{{ url('dashboard') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>

            @if(auth()->user()->role == 'admin')

            <li class="nav-item">
              <a class="nav-link " href="{{ url('outlet') }}">
                <i class="ni ni-shop text-danger"></i>
                <span class="nav-link-text">Outlet</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link " href="{{ url('package') }}">
                <i class="ni ni-folder-17 text-yellow"></i>
                <span class="nav-link-text">Paket</span>
              </a>
            </li>

              <li class="nav-item">
              <a class="nav-link " href="{{ url('member') }}">
                <i class="ni ni-circle-08 text-info"></i>
                <span class="nav-link-text">Pelanggan</span>
              </a>
            </li>
             <li class="nav-item">
                  <a class="nav-link " href="{{ url('user') }}">
                    <i class="ni ni-badge text-dark"></i>
                    <span class="nav-link-text">User</span>
                  </a>
              </li>
            <li class="nav-item">
              <a class="nav-link " href="{{ url('transaction') }}">
                <i class="ni ni-money-coins text-success"></i>
                <span class="nav-link-text">Transaksi</span>
              </a>
            </li>

            @endif

            @if( auth()->user()->role == 'kasir')
            
            <li class="nav-item">
              <a class="nav-link " href="{{ url('member') }}">
                <i class="ni ni-circle-08 text-info"></i>
                <span class="nav-link-text">Pelanggan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="{{ url('transaction') }}">
                <i class="ni ni-money-coins text-success"></i>
                <span class="nav-link-text">Transaksi</span>
              </a>
            </li>
            
          @endif
            <li class="nav-item">
              <a class="nav-link " href="{{ url('report') }}">
                <i class="ni ni-collection text-warning"></i>
                <span class="nav-link-text">Laporan</span>
              </a>
            </li>

          </ul>
          <!-- Divider -->
          
        </div>
      </div>
    </div>
  </nav>