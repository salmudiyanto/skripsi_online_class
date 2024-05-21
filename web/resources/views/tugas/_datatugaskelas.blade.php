
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
      
      <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Tugas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="{{ route('simpantugas') }}" method="post">
                  {{ csrf_field() }}
                  <div class="modal-body">

                  <div class="container">
                      <div class="form-group">
                          <label for="soal">Soal</label>
                          <textarea name="soal" id="soal" class="form-control" cols="30" rows="10"></textarea>
                      </div>  
                      <div class="form-group">
                        <label for="mulai">Mulai Kerjakan</label>
                        <input type="date" name="mulai" class="form-control" id="mulai">
                    </div>          
                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input type="date" name="deadline" class="form-control" id="deadline">
                    </div>                   
                  </div>
                  
                  <input type="hidden" name="kelas" value="{{ $kelas }}">
                  <input type="hidden" name="mapel" value="{{ $mapel }}">
                 

                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Tugas Kelas</h3>
        <div class="card-tools">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">Tambah</a>
          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO. </th>
              <th>Nama Siswa</th>
              <th>Tugas Ke-</th>
              <th>Lihat Tugas</th>
              <th>Nilai</th>
            </tr>
            </thead>
            <tbody>
              @php
                  $no=1;
              @endphp
  
              @foreach ($datatugas as $item)
                  
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->namasiswa }}</td>
                <td>{{ $item->urut }}</td>
                <td>
                  @if ($item->file != '-')
                  <form action="{{ route('filetugassiswa') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="hidden" name="siswa" value="{{ $item->siswaid }}">
                    <input type="hidden" name="idmapel" value="{{ $mapel }}">
                    <input type="hidden" name="urut" value="{{ $item->urut }}">
                    <button type="submit" class="btn btn-primary">Buka</button>
                  </form>
                  @endif 
                </td>
                <td>
                  @if ($item->file != '-')
                  
                    <a href="#" data-toggle="modal" data-target="#modal-nilai{{ $item->id }}" value="Materi" class="btn btn-success">{{ $item->nilai }}</a>
                
                  @endif 
                 
                </td>
              </tr>

              <div class="modal fade" id="modal-nilai{{ $item->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Nilai Tugas</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('tugasnilai') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
      
                        <div class="container">     
                          <div class="form-group">
                              <label for="nilai">Nilai</label>
                              <input type="text" name="nilai" pattern="\d*" maxlength="2" class="form-control" id="nilai">
                          </div>                   
                        </div>
                        
                        <input type="hidden" name="id" value="{{ $item->id }}">
      
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Beri Nilai</button>
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
                <th>Nama Siswa</th>
                <th>Tugas Ke-</th>
                <th>Lihat Tugas</th>
                <th>Nilai</th>
                </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>


   
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Tugas</h3>
        <div class="card-tools">
            {{-- <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">Tambah</a> --}}
          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO. </th>
              <th>Tugas Ke-</th>
              <th>Soal</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              @php
                  $no=1;
              @endphp
  
              @foreach ($listtugas as $item)
                  
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->urut }}</td>
                <td>{!! $item->deskripsi !!}</td>
                <td>
                  <div class="margin">
                    <div class="btn-group">
                      <button type="button" class="btn btn-default">Aksi</button>
                      <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-edit{{ $item->urut }}">Edit</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-hapus{{ $item->urut }}">Hapus</a>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>


              <div class="modal fade" id="modal-edit{{ $item->urut }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Data Tugas</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('simpanedittugas') }}" method="post">
                      {{ csrf_field() }}
                      <div class="modal-body">
                        <input type="hidden" name="idmapel" value="{{ $item->mapel }}">
                        <input type="hidden" name="idurut" value="{{ $item->urut }}">
                        <div class="container">
                          <div class="form-group">
                            <label for="soal">Soal</label>
                            <textarea name="soal" id="soall" class="form-control" cols="30" rows="10">{!! $item->deskripsi !!}</textarea>
                          </div>  
                          <div class="form-group">
                            <label for="mulai">Mulai Kerjakan</label>
                            <input type="date" name="mulai" class="form-control" value="{{ date('Y-m-d', strtotime($item->mulai)) }}" id="mulai">
                          </div>          
                          <div class="form-group">
                              <label for="deadline">Deadline</label>
                              <input type="date" name="deadline" class="form-control" value="{{ date('Y-m-d', strtotime($item->selesai)) }}" id="deadline">
                          </div>     
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>


              <div class="modal fade" id="modal-hapus{{ $item->urut }}">
                <div class="modal-dialog">
                  <div class="modal-content bg-danger">
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus Data Tugas</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('hapustugas') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="idmapel" value="{{ $item->mapel }}">
                        <input type="hidden" name="idurut" value="{{ $item->urut }}">
                        <div class="modal-body">
                            <p>Anda yakin ingin menghapus data jadwal {{ $item->deskripsi }}</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-outline-light">Ya, Hapus!!</button>
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
                <th>Tugas Ke-</th>
                <th>Soal</th>
                <th>Aksi</th>
              </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

  <script src="https://cdn.tiny.cloud/1/900rsud77hgvqnf6rxgnqxrcrbpar1shdv16sk1fro3cf5nh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#soal',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
    tinymce.init({
      selector: '#soall',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>
  @endsection
