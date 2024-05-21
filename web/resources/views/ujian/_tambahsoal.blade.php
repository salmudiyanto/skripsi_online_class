
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
        <form action="{{ route('simpansoal') }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="kelompoksoal" value="{{ $kelompoksoal }}">
          <div class="modal-body">

          <div class="container">
              <div class="form-group">
                  <label for="soal">Soal</label>
                  <input type="text" name="soal" class="form-control" >
              </div>  
              <div class="form-group">
                <label for="a">Pilihan A</label>
                <input type="text" name="a" class="form-control" id="a">
             </div>          
             <div class="form-group">
                <label for="b">Pilihan B</label>
                <input type="text" name="b" class="form-control" id="b">
             </div>          
             <div class="form-group">
                <label for="c">Pilihan A</label>
                <input type="text" name="c" class="form-control" id="c">
             </div>          
             <div class="form-group">
                <label for="d">Pilihan A</label>
                <input type="text" name="d" class="form-control" id="d">
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
