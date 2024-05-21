
@extends('admin')

@section('isiadmin')
    
<div class="col-12">
  @if (Session::has('success'))
  <div class="alert alert-info alert-mg-b">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <strong>Info!</strong> {!! Session::get('success') !!}
  </div>
  @endif
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
                  <h4 class="modal-title">Tambah Data Guru</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('simpanguru') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">

                    <div class="container">
                        <div class="form-group">
                            <label for="namaguru">Nama Guru</label>
                            <input type="text" name="nama_guru" id="namaguru" class="form-control" placeholder="Masukkan Nama Guru">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki">
                                <label class="form-check-label">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan">
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="wali_kelas" value="Y">
                                <label class="form-check-label">Ya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="wali_kelas" value="N">
                                <label class="form-check-label">Tidak</label>
                            </div>
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

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Guru</h3>
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
            <th>NIP</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Aktif</th>
            <th>Wali</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
            @php
                $no=1;
            @endphp

            @foreach ($dataguru as $item)
                
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $item->nip }}</td>
              <td>{{ $item->namaguru }}</td>
              <td>{{ $item->jeniskelamin }}</td>
              <td>{{ $item->aktif }}</td>
              <td>{{ $item->wali }}</td>
              <td>
                <div class="margin">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default">Aksi</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-edit{{ $item->idguru }}">Edit</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-hapus{{ $item->idguru }}">Hapus</a>
                    </div>
                  </div>
                </div>
              </td>
            </tr>

            <div class="modal fade" id="modal-hapus{{ $item->idguru }}">
              <div class="modal-dialog">
                <div class="modal-content bg-danger">
                  <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Guru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="{{ route('hapusguru') }}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="idGuru" value="{{ $item->idguru }}">
                      <input type="hidden" name="idUser" value="{{ $item->iduser }}">
                      <div class="modal-body">
                          <p>Anda yakin ingin menghapus data guru {{ $item->namaguru }}</p>
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

            <div class="modal fade" id="modal-edit{{ $item->idguru }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Data Guru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="{{ route('simpaneditguru') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                      <input type="hidden" name="idGuru" value="{{ $item->idguru }}">
                      <input type="hidden" name="idUser" value="{{ $item->iduser }}">
                      <div class="container">
                        <div class="form-group">
                            <label for="namaguru">Nama Guru</label>
                            <input type="text" name="nama_guru" value="{{ $item->namaguru }}" id="namaguru" class="form-control" placeholder="Masukkan Nama Guru">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" value="{{ $item->nip }}" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" @if ($item->jeniskelamin == "Laki-laki")
                                checked
                            @endif >
                                <label class="form-check-label">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" @if ($item->jeniskelamin == "Perempuan")
                                checked
                            @endif >
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="wali_kelas" value="Y" @if ($item->wali == "Y")
                                checked
                            @endif >
                                <label class="form-check-label">Ya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="wali_kelas" value="N" @if ($item->wali == "N")
                                checked
                            @endif >
                                <label class="form-check-label">Tidak</label>
                            </div>
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
                <th>NIP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Aktif</th>
                <th>Wali</th>
                <th>Aksi</th>
              </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  @endsection
