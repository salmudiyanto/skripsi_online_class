
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
          <form action="{{ route('tambahujian') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="mapel" value="{{ $mapel }}">
            <input type="hidden" name="idkelas" value="{{ $kelas }}">
            <button type="submit" class="btn btn-info">Tambah</button>
          </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO. </th>
              <th>Mapel</th>
              <th>Ujian Ke-</th>
              <th>Jumlah Soal Tersedia</th>
              <th>Mulai Ujian</th>
            </tr>
            </thead>
            <tbody>
              @php
                  $no=1;
              @endphp
  
              @foreach ($dataujian as $item)
                  
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->namamapel }}</td>
                <td>{{ $item->urut }}</td>
                <td>{{ $item->jumlahPG }} & {{ $item->jumlahessay }}</td>
                <td>
                  @if ($item->stat == 'B' && $item->jumlahPG >= $item->pilgan && $item->jumlahessay >= $item->essay)
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal{{ $item->id }}">Mulai</a> | 
                  @endif
                  @if ($item->stat == 'B')
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modalhapus{{ $item->id }}">Hapus</a> |   
                  @endif
                  @if ($item->stat == 'S')
                    <a href="{{ route('nilaiujiansiswa', ['id'=> $item->id]) }}" class="btn btn-success">Nilai</a> | 
                  @endif
                  <a href="{{ route('banksoal', ['id' => $item->id]) }}" class="btn btn-primary">Soal</a>  
                </td>
              </tr>

              <div class="modal fade" id="modal{{ $item->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Scan Ujian</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                        <div class="modal-body">
					                {!! QrCode::size(300)->generate($item->qr) !!}
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                            <form action="{{ route('selesaikanujian') }}" method="post">
                              <input type="hidden" name="idUjian" value="{{ $item->id }}">
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-primary">Selesai</button>
                            </form>
                        </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>


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
                          <form action="{{ route('hapusujian') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="idujian" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-outline-light">Ya, Hapus!!</button>
                          </form>
                            
                        </div>
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
                <th>Mata Pelajaran</th>
                <th>Ujian Ke-</th>
                <th>Jumlah Soal Tersedia</th>
                <th>Mulai Ujian</th>
              </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  @endsection
