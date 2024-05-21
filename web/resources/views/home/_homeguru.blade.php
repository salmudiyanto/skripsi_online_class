@extends('guru')

@section('isiguru')
<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
        
        <div class="info-box-content">
            <span class="info-box-text">Kelas Mengajar</span>
            <span class="info-box-number">
                {{ $kelas }}
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
        
        <div class="info-box-content">
            <span class="info-box-text">Mata Pelajaran Mengajar</span>
            <span class="info-box-number">{{ $mapel }}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>

<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
        
        <div class="info-box-content">
            <span class="info-box-text">Materi Mata Pelajaran</span>
            <span class="info-box-number">{{ $materi }}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
@endsection