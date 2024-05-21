
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
                  <h4 class="modal-title">Tambah Data Siswa</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('simpansiswa') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">

                    <div class="container">
                        <div class="form-group">
                            <label for="namasiswa">Nama Siswa</label>
                            <input type="text" name="nama_siswa" id="namasiswa" class="form-control" placeholder="Masukkan Nama Siswa">
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
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="" class="form-control">
                                @foreach ($datakelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->namakelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select name="agama" id="" class="form-control">
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Budha">Budha</option>
                                <option value="Hindu">Hindu</option>
                            </select>
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
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
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
        <h3 class="card-title">Data Siswa</h3>
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
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Agama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
            @php
                $no=1;
            @endphp

            @foreach ($datasiswa as $item)
                
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $item->idsiswa }}</td>
              <td>{{ $item->namasiswa }}</td>
              <td>{{ $item->namakelas }}</td>
              <td>{{ $item->agama }}</td>
              <td>{{ $item->alamat }}</td>
              <td>{{ $item->jenis_kelamin }}</td>
              <td>
                <div class="margin">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default">Aksi</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-edit{{ $item->idsiswa }}">Edit</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-hapus{{ $item->idsiswa }}">Hapus</a>
                    </div>
                  </div>
                </div>
              </td>
            </tr>

            <div class="modal fade" id="modal-hapus{{ $item->idsiswa }}">
              <div class="modal-dialog">
                <div class="modal-content bg-danger">
                  <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Kelas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="{{ route('hapussiswa') }}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="idSiswa" value="{{ $item->idsiswa }}">
                      <input type="hidden" name="idUser" value="{{ $item->iduser }}">
                      <div class="modal-body">
                          <p>Anda yakin ingin menghapus data siswa {{ $item->namasiswa }}</p>
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

            <div class="modal fade" id="modal-edit{{ $item->idsiswa }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Data Kelas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="{{ route('simpaneditsiswa') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                      <input type="hidden" name="idSiswa" value="{{ $item->idsiswa }}">
                      <input type="hidden" name="idUser" value="{{ $item->iduser }}">
                    <div class="container">
                        <div class="form-group">
                            <label for="namasiswa">Nama Siswa</label>
                            <input type="text" value="{{ $item->namasiswa }}" name="nama_siswa" id="namasiswa" class="form-control" placeholder="Masukkan Nama Siswa">
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="" class="form-control">
                                @foreach ($datakelas as $itemkelas)
                                    <option value="{{ $itemkelas->id }}" @if ($itemkelas->id == $item->kelas)
                                        "selected"
                                    @endif >{{ $itemkelas->namakelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select name="agama" id="" class="form-control">
                                <option value="Islam" @if ($item->agama == "Islam")
                                    "selected"
                                @endif >Islam</option>
                                <option value="Kristen" @if ($item->agama == "Kristen")
                                    "selected"
                                @endif >Kristen</option>
                                <option value="Protestan" @if ($item->agama == "Protestan")
                                    "selected"
                                @endif >Protestan</option>
                                <option value="Budha" @if ($item->agama == "Budha")
                                    "selected"
                                @endif >Budha</option>
                                <option value="Hindu" @if ($item->agama == "Hindu")
                                    "selected"
                                @endif >Hindu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" @if ($item->jenis_kelamin == "Laki-laki")
                                    checked
                                @endif >
                                <label class="form-check-label">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" @if ($item->jenis_kelamin == "Perempuan")
                                checked
                            @endif >
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10">{{ $item->alamat }}</textarea>
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
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Agama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
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
