
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
                  <h4 class="modal-title">Tambah Data Kelas</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('simpankelas') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">

                    <div class="container">
                        <div class="form-group">
                            <label for="namakelas">Nama Kelas</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <select name="namakelas" id="" class="form-control">
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="namapaket">
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="tahunajaran">Tahun Ajaran</label>
                            <input type="number" name="tahunajaran" id="tahunajaran" class="form-control" placeholder="Masukkan Tahun Ajaran">
                        </div>
                        <div class="form-group">
                            <label for="Semester">Semester</label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <select name="semester" id="semester" class="form-control">
                                        <option value="ganjil">Ganjil</option>
                                        <option value="genap">Genap</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="walikelas">Wali Kelas</label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <select name="walikelas" id="walikelas" class="form-control">
                                        @foreach ($dataguru as $item)
                                            <option value="{{ $item->idguru }}">{{ $item->namaguru }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                   

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Kelas</h3>
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
            <th>Nama Kelas</th>
            <th>Tahun Ajaran</th>
            <th>Semester</th>
            <th>Wali Kelas</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
            @php
                $no=1;
            @endphp

            @foreach ($datakelas as $item)
                
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $item->namakelas }}</td>
              <td>{{ $item->tahunajaran }}</td>
              <td>{{ $item->semester }}</td>
              <td>{{ $item->namagurus }}</td>
              <td>
                <div class="margin">
                    <div class="btn-group">
                      <button type="button" class="btn btn-default">Aksi</button>
                      <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-edit{{ $item->id }}">Edit</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-hapus{{ $item->id }}">Hapus</a>
                      </div>
                    </div>
                  </div>
                
              </td>
              
              <div class="modal fade" id="modal-edit{{ $item->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Data Kelas</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('simpaneditkelas') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="idKelas" value="{{ $item->id }}">

                        @php
                            $namakelas = Str::substr($item->namakelas, 0, 1);
                            $namapaket = Str::substr($item->namakelas, 1, 1);
                        @endphp
                        <div class="modal-body">
    
                        <div class="container">
                            <div class="form-group">
                                <label for="namakelas">Nama Kelas</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select name="namakelas" id="" class="form-control">
                                            <option value="7" @php
                                                if($namakelas == '7'){ echo "selected"; }
                                            @endphp>7</option>
                                            <option value="8" @php
                                                if($namakelas == '8'){ echo "selected"; }
                                            @endphp>8</option>
                                            <option value="9" @php
                                                if($namakelas == '9'){ echo "selected"; }
                                            @endphp>9</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="{{ $namapaket }}" name="namapaket">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="tahunajaran">Tahun Ajaran</label>
                                <input type="number" name="tahunajaran" id="tahunajaran" value="{{ $item->tahunajaran }}" class="form-control" placeholder="Masukkan Tahun Ajaran">
                            </div>
                            <div class="form-group">
                                <label for="Semester">Semester</label>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <select name="semester" id="semester" class="form-control">
                                            <option value="ganjil" @php
                                                if($item->semester == "ganjil"){ echo "selected"; }
                                            @endphp>Ganjil</option>
                                            <option value="genap" @php
                                                if($item->semester == "genap"){ echo "selected"; }
                                            @endphp>Genap</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="walikelas">Wali Kelas</label>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <select name="walikelas" id="walikelas" class="form-control">
                                            @foreach ($dataguru as $guru)
                                                <option value="{{ $guru->idguru }}" @if ($guru->idguru == $item->walikelas)
                                                    "selected"
                                                @endif >{{ $guru->namaguru }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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


              <div class="modal fade" id="modal-hapus{{ $item->id }}">
                <div class="modal-dialog">
                  <div class="modal-content bg-danger">
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus Data Kelas</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('hapuskelas') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="idKelas" value="{{ $item->id }}">

                        <div class="modal-body">
                            <p>Anda yakin ingin menghapus data kelas {{ $item->namekalas }}</p>
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
              <!-- /.modal -->
              
            </tr>

            

            @endforeach
          
          </tbody>
          <tfoot>
            <tr>
                <th>NO. </th>
                <th>Nama Kelas</th>
                <th>Tahun Ajaran</th>
                <th>Semester</th>
                <th>Wali Kelas</th>
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
