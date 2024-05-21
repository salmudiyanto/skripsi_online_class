
@extends('siswa')

@section('isisiswa')
    
<div class="col-12">
  
    @foreach ($errors->all() as $error)
                                            
    <div class="alert alert-danger alert-mg-b">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Danger!</strong> {{ $error }}
    </div>
    
    @endforeach

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Kuis Ke-{{ $datakuis->urut }} {{ $datakuis->nama_mapel }}</h3>
        <div class="card-tools">
            {{-- <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">Tambah</a> --}}
          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form action="{{ route('kumpulkuis') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="idkuis" value="{{ $datakuis->id }}">
            <div class="row">
                <div class="col-lg-12 form-group">
                {!! $datakuis->deskripsi !!}
            </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <input type="file" name="file_kuis" class="form-control form-group" id="">
                </div>
                <div class="col-lg-9">
                    *File yang diupload harus berupa gambar atau pdf
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-info form-groups">Upload Tugas</button>
                </div>
            </div>
        </form>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  @endsection
