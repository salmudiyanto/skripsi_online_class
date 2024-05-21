
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
        <h3 class="card-title">Nilai Ujian Siswa</h3>
        <div class="card-tools">
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO. </th>
              <th>Mapel</th>
              <th>Nama Siswa</th>
              <th>Nilai Ujian Pilihan Ganda</th>
              <th>Nilai Ujian Essay</th>
              <th>Total Nilai</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              @php
                  $no=1;
              @endphp
  
              @foreach ($datanilai as $item)
                  
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->namamapel }}</td>
                <td>{{ $item->namasiswa }}</td>
                <td>{{ $item->pilihangandanilai }}</td>
                <td>{{ (double) ($item->nilaiessay/$item->bobothitung)*40 }}</td>
                <td>{{ (double) (($item->nilaiessay/$item->bobothitung)*40)+$item->pilihangandanilai }}</td>
                <td>
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal{{ $item->id }}">Periksa</a>
                </td>
              </tr>


              <div class="modal fade" id="modal{{ $item->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Nilai Ujian</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- <form action="" method="post"> --}}
                        <div class="modal-body">
                            @foreach ($item->jawabessay as $item)
                            <form action="{{ route('updatenilai') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="idJawab" value="{{ $item->id }}">
                                <input type="hidden" name="idSoal" value="{{ $item->id_soal }}">
                                <input type="hidden" name="idSiswa" value="{{ $item->siswa }}">
                                <input type="hidden" name="idUjian" value="{{ $idUjian }}">
                                <div class="form-group">
                                    <label for="{{ $item->id }}">Soal : {{ $item->soal }} </label>
                                </div>
                                <div class="form-group">
                                    <label>Jawab : {{ $item->jawaban }} </label>
                                </div>
                                <div class="form-group">
                                    <label>Bobot : [0~{{ $item->bobot }}] </label>
                                    <input type="text" name="nilai" placeholder="Masukkan Nilai" value="{{ $item->nilai_jawaban }}" class="form-control" id="{{ $item->id }}">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">Update</button>
                                </div>     
                            </form>
                            @endforeach
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                            {{-- <button type="submit" class="btn btn-primary">Update Nilai</button>  --}}
                        </div>
                    {{-- </form> --}}
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
                <th>Mapel</th>
                <th>Nama Siswa</th>
                <th>Nilai Ujian Pilihan Ganda</th>
                <th>Nilai Ujian Essay</th>
                <th>Total Nilai</th>
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
