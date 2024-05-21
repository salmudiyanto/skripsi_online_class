
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
                <h4 class="modal-title">Tambah Data Materi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="{{ route('simpanmateri') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" name="idmapel" value="{{ $keymapel }}">
                  <div class="modal-body">

                  <div class="container">
                      <div class="form-group">
                          <label for="judul">Judul Materi</label>
                          <input type="text" name="judul_materi" id="judul" class="form-control" placeholder="Masukkan Judul Materi">
                      </div>
                      <div class="form-group">
                        <label for="tingkat">Tingkat</label>
                        <div class="row">
                            <div class="col-lg-12">
                                <select name="tingkat" id="tingkat" class="form-control">
                                        <option value="7">Kelas 7</option>
                                        <option value="8">Kelas 8</option>
                                        <option value="9">Kelas 9</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="pilihtahun">Tahun Ajaran</label>
                      <input type="text" name="tahun_ajaran" id="pilihtahun" class="form-control" placeholder="Masukkan Tahun Ajaran">
                    </div>
                    <div class="form-group">
                      <label for="deskripsi">Deskripsi</label>
                      <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="filemateri">File Materi</label>
                      <input type="file" name="filemateri" id="filemateri" class="form-control" accept="application/pdf">
                    </div>
                      {{-- <div class="form-group">
                          <label for="walikelas">Guru</label>
                          <div class="row">
                              <div class="col-lg-12">
                                  <select name="guru" id="walikelas" class="form-control">
                                      @foreach ($dataguru as $item)
                                          <option value="{{ $item->idguru }}">{{ $item->namaguru }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div> --}}
                      
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


    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Materi Pelajaran {{ $pelajaran }}</h3>
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
              <th>Nama Mata Pelajaran</th>
              <th>Pertemuan Ke-</th>
              <td>Judul	</td>
              <td>Tingkat</td>
              <td>Tahun Ajaran</td>
              <td>Deskripsi</td>
              <td>File</td>
              <th>Aksi</th>

            </tr>

            {{-- id	
              	created_at	updated_at --}}
            </thead>
            <tbody>
              @php
                  $no=1;
              @endphp
  
              @foreach ($datamapel as $item)
                  
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->nama_mapel }}</td>
                <td>Ke-{{ $item->urut }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->tingkat }}</td>
                <td>{{ $item->tahunajaran }}</td>
                <td>{!! $item->deskripsi !!} </td>
                <td> <a href="{{ asset('filemateri/'.$item->file) }}" target="_blank"><i class="fas fa-book"></i></a></td>
                <td>
                  <a href="#" data-toggle="modal" data-target="#modaledit{{ $item->idmateri }}" class="btn btn-warning">Edit</a>
                  <form action="{{ route("hapusmateri") }}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="idmapel" value="{{ $keymapel }}">
                      <input type="hidden" name="id" value="{{ $item->idmateri }}">
                      <button type="submit" value="Materi" name="" class="btn btn-danger">Hapus</button>
                  </form>
                </td>
              </tr>

              <div class="modal fade" id="modaledit{{ $item->idmateri }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Materi</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('simpaneditmateri') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="idmapel" value="{{ $keymapel }}">
                        <input type="hidden" name="idmateri" value="{{ $item->idmateri }}">
                        <div class="modal-body">

                        <div class="container">
                            <div class="form-group">
                                <label for="judul">Judul Materi</label>
                                <input type="text" name="judul_materi" value="{{ $item->judul }}" id="judul" class="form-control" placeholder="Masukkan Judul Materi">
                            </div>
                            <div class="form-group">
                              <label for="tingkat">Tingkat</label>
                              <div class="row">
                                  <div class="col-lg-12">
                                      <select name="tingkat" id="tingkat" class="form-control">
                                              <option value="7" @if ($item->tingkat)
                                                  selected
                                              @endif>Kelas 7</option>
                                              <option value="8" @if ($item->tingkat)
                                                  selected
                                              @endif>Kelas 8</option>
                                              <option value="9" @if ($item->tingkat)
                                                  selected
                                              @endif>Kelas 9</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <label for="pilihtahun">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" id="pilihtahun" value="{{ $item->tahunajaran }}" class="form-control" placeholder="Masukkan Tahun Ajaran">
                          </div>
                          <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi{{ $item->idmateri }}" cols="30" rows="10">{{ $item->deskripsi }}</textarea>
                          </div>
                          <div class="form-group">
                            <label for="filemateri">File Materi</label>
                            <input type="file" name="filemateri" id="filemateri" class="form-control" accept="application/pdf">
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

              
  
              @endforeach
            
            </tbody>
            <tfoot>
              <tr>
                <th>NO. </th>
                <th>Nama Mata Pelajaran</th>
                <th>Pertemuan Ke-</th>
                <td>Judul	</td>
                <td>Tingkat</td>
                <td>Tahun Ajaran</td>
                <td>Deskripsi</td>
                <td>File</td>
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
@foreach ($datamapel as $item)
<script>
      tinymce.init({
        selector: '#deskripsi{{ $item->idmateri }}',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
      });
      </script>
@endforeach
<script>
  tinymce.init({
    selector: '#deskripsi',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
  });
  tinymce.init({
    selector: '#deskripsii',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
  });
</script>
  @endsection
