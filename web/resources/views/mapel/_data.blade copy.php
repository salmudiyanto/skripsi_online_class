
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
                    <input type="hidden" value="{{ $idkelas }}">
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
                                    </select>                            
                        </div>
                        <div class="form-group">
                            <label for="jam">Jam</label>
                                    <select name="jam" id="" class="form-control">
                                        <option value="07:00:00">07.00 s/d 08.00</option>
                                        <option value="08:00:00">08.00 s/d 09.00</option>
                                        <option value="10:00:00">10.00 s/d 11.00</option>
                                        <option value="11:00:00">11.00 s/d 12.00</option>
                                        <option value="13:00:00">13.00 s/d 14.00</option>                                        
                                    </select>                            
                        </div>
                        
                        <div class="form-group">
                            <label for="mapel">Mata Pelajaran</label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <select name="mapel" id="mapel" class="form-control">
                                        @foreach ($mapel as $item)
                                            <option value="{{ $item->id }}">{{ $item->namamapel }} {{ $item->namaguru }}</option>
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
                <form action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <button type="submit" value="Edit" name="" class="btn btn-warning">Edit</button>
                </form>
                <form action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <button type="submit" value="Hapus" name="" class="btn btn-danger">Hapus</button>
                </form>
              </td>
            </tr>

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
