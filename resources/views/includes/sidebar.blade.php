<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('assets/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MTs. Nurul Huda</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.siswa.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Data Siswa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.kelas.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Data Kelas
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="{{ route('admin.jurusan.index') }}" class="nav-link">
              <i class="nav-icon fas fa-map-signs"></i>
              <p>
                Data Jurusan
              </p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{ route('admin.pembayaran.index') }}" class="nav-link">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                Data Pembayaran
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.transaksi.index') }}" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave-alt"></i>
              <p>
                Data Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.laporan.index') }}" class="nav-link">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p>
                Data Laporan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
