
@extends('admin')

@section('isiadmin')
    
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
                  <h4 class="modal-title">Tambah Data Kelas</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('simpanjadwalkelas') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $idkelas }}" name="idkelas">
                    <div class="modal-body">

                    <div class="container">
                        <div class="form-group">
                            <label for="hari">Hari</label>
                                    <select name="hari" id="" class="form-control">
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>                            
                        </div>
                        <div class="form-group">
                            <label for="jam">Jam</label>
                                    <select name="jam" id="" class="form-control">
                                        <option value="07:30:00">07.30 s/d 08.10</option>
                                        <option value="08:10:00">08.10 s/d 08.50</option>
                                        <option value="08:50:00">08.50 s/d 09.30</option>
                                        <option value="09:30:00">09.30 s/d 09.50</option>
                                        <option value="09:50:00">09.50 s/d 10.30</option>
                                        <option value="10:30:00">10.30 s/d 11.10</option>
                                        <option value="11:30:00">11.30 s/d 12.10</option>
                                        <option value="12:10:00">12.10 s/d 12.50</option>
                                        <option value="12:50:00">12.50 s/d 13.30</option>
                                    </select>                            
                        </div>
                        
                        <div class="form-group">
                            <label for="mapel">Mata Pelajaran</label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <select name="mapel" id="mapel" class="form-control">
                                        @foreach ($mapel as $item)
                                            <option value="{{ $item->idmapel }}">{{ $item->namamapel }} {{ $item->namaguru }}</option>
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
            <th>Hari</th>
            <th>Mata Pelajaran</th>
            <th>Kelas</th>
            <th>Guru</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
            @php
                $no=1;
            @endphp

            @foreach ($datakelas as $item)
                
            <tr>
              {{-- <td>{{ $no++ }}</td> --}}
              <td>{{ $no++ }}</td>
              <td>{{ $item->hari }}</td>
              <td>{{ $item->namamapel }}</td>
              <td>{{ $item->namakelas }}</td>
              <td>{{ $item->namaguru }}</td>
              <td>
                <div class="margin">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default">Aksi</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-edit{{ $item->idjadwal }}">Edit</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-hapus{{ $item->idjadwal }}">Hapus</a>
                    </div>
                  </div>
                </div>
              </td>
            </tr>

            <div class="modal fade" id="modal-hapus{{ $item->idjadwal }}">
              <div class="modal-dialog">
                <div class="modal-content bg-danger">
                  <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="{{ route('hapusjadwal') }}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="idJadwal" value="{{ $item->idjadwal }}">
                      <div class="modal-body">
                          <p>Anda yakin ingin menghapus data jadwal {{ $item->hari }} {{ $item->namakelas }} {{ $item->hari }}</p>
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

            <div class="modal fade" id="modal-edit{{ $item->idjadwal }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Data Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="{{ route('simpaneditjadwal') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                      <input type="hidden" name="idJadwal" value="{{ $item->idjadwal }}">
                      <div class="container">
                        <div class="form-group">
                            <label for="hari">Hari</label>
                                    <select name="hari" id="" class="form-control">
                                        <option value="Senin" @if ($item->hari == "Senin")
                                            selected
                                        @endif >Senin</option>
                                        <option value="Selasa" @if ($item->hari == "Selasa")
                                            selected
                                        @endif >Selasa</option>
                                        <option value="Rabu" @if ($item->hari == "Rabu")
                                            selected
                                        @endif >Rabu</option>
                                        <option value="Kamis" @if ($item->hari == "Kamis")
                                            selected
                                        @endif >Kamis</option>
                                        <option value="Jumat" @if ($item->hari == "Jumat")
                                            selected
                                        @endif >Jumat</option>
                                        <option value="Sabtu" @if ($item->hari == "Sabtu")
                                          selected
                                      @endif >Sabtu</option>
                                    </select>                            
                        </div>
                        <div class="form-group">
                            <label for="jam">Jam</label>
                                    <select name="jam" id="" class="form-control">
                                      <option value="07:30:00"@if ($item->jampelajaran) 
                                        selected
                                        @endif >07.30 s/d 08.10</option>
                                      <option value="08:10:00"@if ($item->jampelajaran) 
                                        selected
                                        @endif >08.10 s/d 08.50</option>
                                      <option value="08:50:00"@if ($item->jampelajaran) 
                                        selected
                                        @endif >08.50 s/d 09.30</option>
                                      <option value="09:30:00"@if ($item->jampelajaran) 
                                        selected
                                        @endif >09.30 s/d 09.50</option>
                                      <option value="09:50:00"@if ($item->jampelajaran) 
                                        selected
                                        @endif >09.50 s/d 10.30</option>
                                      <option value="10:30:00"@if ($item->jampelajaran) 
                                        selected
                                        @endif >10.30 s/d 11.10</option>
                                      <option value="11:30:00"@if ($item->jampelajaran) 
                                        selected
                                        @endif >11.30 s/d 12.10</option>
                                      <option value="12:10:00"@if ($item->jampelajaran) 
                                        selected
                                        @endif >12.10 s/d 12.50</option>
                                      <option value="12:50:00"@if ($item->jampelajaran) 
                                        selected
                                        @endif >12.50 s/d 13.30</option>
                                        {{-- <option value="07:00:00" @if ($item->jampelajaran)
                                            selected
                                        @endif >07.00 s/d 08.00</option>
                                        <option value="08:00:00" @if ($item->jampelajaran)
                                            selected
                                        @endif >08.00 s/d 09.00</option>
                                        <option value="10:00:00" @if ($item->jampelajaran)
                                            selected
                                        @endif >10.00 s/d 11.00</option>
                                        <option value="11:00:00" @if ($item->jampelajaran)
                                            selected
                                        @endif >11.00 s/d 12.00</option>
                                        <option value="13:00:00" @if ($item->jampelajaran)
                                            selected
                                        @endif >13.00 s/d 14.00</option>                                         --}}
                                    </select>                            
                        </div>
                        
                        <div class="form-group">
                            <label for="mapel">Mata Pelajaran</label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <select name="mapel" id="mapel" class="form-control">
                                        @foreach ($mapel as $itemmapel)
                                            <option value="{{ $itemmapel->idmapel }}" @if ($item->mapel == $itemmapel->idmapel)
                                                
                                            @endif >{{ $itemmapel->namamapel }} {{ $itemmapel->namaguru }}</option>
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

            @endforeach
          
          </tbody>
          <tfoot>
            <tr>
                <th>NO. </th>
                <th>Hari</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Guru</th>
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
