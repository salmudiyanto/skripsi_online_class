@include('_header')

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="#" class="d-block">Siswa</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('siswa') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('siswamateri') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Materi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('siswatugas') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Tugas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('siswahasiltugas') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Hasil Tugas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('siswakuis') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Kuis
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('siswahasilkuis') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Hasil Kuis
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Forum Diskusi
              </p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @yield('isisiswa')
        </div>
        <!-- /.row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('_footer')