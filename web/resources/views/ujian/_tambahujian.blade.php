
@extends('guru')

@section('isiguru')
    
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
        <h3 class="card-title">Data Ujian</h3>
        <div class="card-tools">
            
          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form action="{{ route('simpanujian') }}" method="post">
          {{ csrf_field() }}
          <div class="modal-body">

          <div class="container">
              <div class="form-group">
                  <label for="soal">Mata Pelajaran</label>
                  <input type="text" name="namamapel" class="form-control" value="{{ $namamapel }}" id="" readonly>
                  <input type="hidden" name="mapel" class="form-control" value="{{ $mapel }}" id="">
                  <input type="hidden" name="idkelas" class="form-control" value="{{ $kelas }}" id="">
              </div>  
              <div class="form-group">
                <label for="tgl">Tanggal Ujian</label>
                <input type="date" name="tgl" class="form-control" id="tgl">
            </div>          
            <div class="form-group">
                <label for="waktu">Jam</label>
                <input type="time" name="waktu" class="form-control" id="waktu">
            </div>                   
            <div class="form-group">
              <label for="lama">Lama Ujian</label>
              <select name="lama" class="form-control" id="">
                <option value="30">30 Menit</option>
                <option value="60">60 Menit</option>
                <option value="90">90 Menit</option>
                <option value="120">120 Menit</option>
              </select>
          </div>                   
          </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan Ujian</button>
          </div>
      </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  @endsection
