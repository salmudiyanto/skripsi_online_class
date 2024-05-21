
@extends('siswa')

@section('isisiswa')
    
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Materi {{ $materi->judul }}, Untuk tahun ajaran {{ $materi->tahunajaran }}, Tingkat {{ $materi->tingkat }}</h3>
      <div class="card-tools">
          {{-- <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">Tambah</a> --}}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <p>
        {!! $materi->deskripsi !!}
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  
  <div class="card" style="min-height: 720px">
    <div class="card-header">
      <div class="card-tools">
          {{-- <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">Tambah</a> --}}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <iframe src="{{ asset('filemateri/'.$materi->file) }}" frameborder="0" style="width: 100%; height: 100%;"></iframe>
    </div>
    <!-- /.card-body -->
  </div>

  
    
    <!-- /.card -->
  </div>
  <script src="https://cdn.tiny.cloud/1/900rsud77hgvqnf6rxgnqxrcrbpar1shdv16sk1fro3cf5nh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#deskripsi',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
  });
</script>
  @endsection
