
@extends('guru')

@section('isiguru')
    
<div class="col-12">
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Tugas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
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
                  <label for="c">Pilihan C</label>
                  <input type="text" name="c" class="form-control" id="c">
               </div>          
               <div class="form-group">
                  <label for="d">Pilihan D</label>
                  <input type="text" name="d" class="form-control" id="d">
               </div>  
               <div class="form-group">
                <label for="jawaban">Jawaban Benar</label>
                <select name="jawaban" class="form-control" id="">
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
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
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Soal Pilihan Ganda</h3>
        <div class="card-tools">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">Tambah</a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO. </th>
              <th>Soal</th>
              <th>Pilihan A</th>
              <th>Pilihan B</th>
              <th>Pilihan C</th>
              <th>Pilihan D</th>
              <th>Jawaban</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              @php
                  $no=1;
              @endphp
  
              @foreach ($datasoal as $item)
                  
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->soal }}</td>
                <td>{{ $item->a }}</td>
                <td>{{ $item->b }}</td>
                <td>{{ $item->c }}</td>
                <td>{{ $item->d }}</td>
                <td>{{ $item->jawaban_benar }}</td>
                <td>
                  <a href="#" data-toggle="modal" data-target="#modalhapus{{ $item->id }}" class="btn btn-danger" >Hapus</a> | <a href="#" data-toggle="modal" data-target="#modaledit{{ $item->id }}" class="btn btn-warning">Edit</a>
                </td>
              </tr>


              <div class="modal fade" id="modalhapus{{ $item->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus Ujian</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                        <div class="modal-body">
					                Apakah anda yakin ingin menghapus?
                        </div>
                        <div class="modal-footer justify-content-between">
                          <form action="{{ route('hapussoal') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="kelompoksoal" value="{{ $kelompoksoal }}">
                            <button type="submit" class="btn btn-outline-light">Ya, Hapus!!</button>
                          </form>
                            
                        </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>


              <div class="modal fade" id="modaledit{{ $item->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Tugas</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('simpaneditsoal') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="kelompoksoal" value="{{ $kelompoksoal }}">
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="modal-body">
              
                        <div class="container">
                            <div class="form-group">
                                <label for="soal">Soal</label>
                                <input type="text" name="soal" value="{{ $item->soal }}" class="form-control" >
                            </div>  
                            <div class="form-group">
                              <label for="a">Pilihan A</label>
                              <input type="text" name="a" class="form-control" id="a" value="{{ $item->a }}">
                           </div>          
                           <div class="form-group">
                              <label for="b">Pilihan B</label>
                              <input type="text" name="b" class="form-control" id="b" value="{{ $item->b }}">
                           </div>          
                           <div class="form-group">
                              <label for="c">Pilihan C</label>
                              <input type="text" name="c" class="form-control" id="c" value="{{ $item->c }}">
                           </div>          
                           <div class="form-group">
                              <label for="d">Pilihan D</label>
                              <input type="text" name="d" class="form-control" id="d" value="{{ $item->d }}">
                           </div>  
                           <div class="form-group">
                            <label for="jawaban">Jawaban Benar</label>
                            <select name="jawaban" class="form-control" id="">
                                <option value="a" @if ($item->jawaban_benar == 'a')
                                    selected
                                @endif>A</option>
                                <option value="b" @if ($item->jawaban_benar == 'b')
                                    selected
                                @endif>B</option>
                                <option value="c" @if ($item->jawaban_benar == 'c')
                                    selected
                                @endif>C</option>
                                <option value="d" @if ($item->jawaban_benar == 'd')
                                    selected
                                @endif>D</option>
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
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
      
              @endforeach
            
            </tbody>
            <tfoot>
              <tr>
                <th>NO. </th>
              <th>Soal</th>
              <th>Pilihan A</th>
              <th>Pilihan B</th>
              <th>Pilihan C</th>
              <th>Pilihan D</th>
              <th>Jawaban</th>
              <th>Aksi</th>
              </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

     
<div class="col-12">
  @foreach ($errors->all() as $error)
                                            
  <div class="alert alert-danger alert-mg-b">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <strong>Danger!</strong> {{ $error }}
  </div>
  
  @endforeach

  <div class="modal fade" id="modal-tambahe">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Soal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('simpansoale') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="kelompoksoal" value="{{ $kelompoksoal }}">
            <div class="modal-body">
              <div class="container">
                <div id="essay">
                  <div class="form-group">
                    <label for="soal">Soal</label>
                    <textarea name="soal" id="" cols="30" rows="10" class="form-control" placeholder="Masukkan Soal"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="bobot">Bobot</label>
                    <input type="text" name="bobot" id="" class="form-control">
                  </div>  
                </div>      
              </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Ujian</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

      
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Soal Essay</h3>
        <div class="card-tools">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-tambahe">Tambah</a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO. </th>
              <th>Soal</th>
              <th>Bobot Nilai</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              @php
                  $no=1;
              @endphp
  
              @foreach ($datasoale as $item)
                  
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->soal }}</td>
                <td>{{ $item->bobot }}</td>
                <td>
                  <a href="#" data-toggle="modal" data-target="#modalhapuse{{ $item->id }}" class="btn btn-danger" >Hapus</a> | <a href="#" data-toggle="modal" data-target="#modaledite{{ $item->id }}" class="btn btn-warning">Edit</a>
                </td>
              </tr>

              <div class="modal fade" id="modalhapuse{{ $item->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus Ujian</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                        <div class="modal-body">
					                Apakah anda yakin ingin menghapus?
                        </div>
                        <div class="modal-footer justify-content-between">
                          <form action="{{ route('hapussoale') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="kelompoksoal" value="{{ $kelompoksoal }}">
                            <button type="submit" class="btn btn-outline-light">Ya, Hapus!!</button>
                          </form>
                            
                        </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>


              <div class="modal fade" id="modaledite{{ $item->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Tugas</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('simpaneditsoale') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="kelompoksoal" value="{{ $kelompoksoal }}">
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="modal-body">
              
                          <div class="container">
                            <div class="form-group">
                              <label for="soal">Soal</label>
                              <textarea name="soal" id="" cols="30" rows="10" class="form-control" placeholder="Masukkan Soal">{{ $item->soal }}</textarea>
                            </div>
                            <div class="form-group">
                              <label for="bobot">Bobot</label>
                              <input type="text" name="bobot" id="bobot" class="form-control" value="{{ $item->bobot }}">
                            </div>         
                          </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Ujian</button>
                        </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
      
              @endforeach
            
            </tbody>
            <tfoot>
              <tr>
                <th>NO. </th>
                <th>Soal</th>
                <th>Bobot Nilai</th>
                <th>Aksi</th>
              </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <script>
    function gantiada(ada, baru){
      document.getElementById("komponenada").style.display = ada;
      document.getElementById("komponenbaru").style.display = baru;
    }
  </script>
  @endsection
