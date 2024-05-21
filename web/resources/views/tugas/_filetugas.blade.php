
@extends('guru')

@section('isiguru')
    
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tugas {{ $datatugas->namasiswa }}</h3>
      <div class="card-tools">
          {{-- <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">Tambah</a> --}}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <p>
        {!! $datatugas->deskripsi !!}
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  
  <div class="card" style="min-height: 720px">
    <div class="card-header">
      <form action="{{ route('tugasnilai') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $datatugas->id }}">

        <div class="row">
            <div class="col-lg-3">
                <input type="text" class="form-control" pattern="\d*" maxlength="2" value="{{ $datatugas->nilai }}" name="nilai" placeholder="Masukkan nilai">
            </div>
            <div class="col-lg-3">
                <button class="btn btn-success">Simpan Nilai</button>
            </div>
        </div>
        

      </form>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      @if ($datatugas->file !== '-')
        <iframe src="{{ asset('filetugas/'.$datatugas->file) }}" frameborder="0" style="width: 100%; height: 1000px;"></iframe>  
      @endif
      @if ($datatugas->jawab !== '-')
          {{ $datatugas->jawab }}
      @endif
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
