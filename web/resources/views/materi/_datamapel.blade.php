
@extends('guru')

@section('isiguru')
    
<div class="col-12">
    

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Mata Pelajaran</h3>
        {{-- <div class="card-tools">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">Tambah</a>
          </div> --}}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO. </th>
              <th>Nama Mata Pelajaran</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              @php
                  $no=1;
              @endphp
  
              @foreach ($datamapel as $item)
                  
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->namamapel }}</td>
                <td>
                  <form action="{{ route('kelasmateri', ['id' => $item->idmapel]) }}" method="get">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{ $item->idmapel }}">
                      <button type="submit" value="Materi" class="btn btn-info">Materi</button>
                  </form>
                </td>
              </tr>
  
              @endforeach
            
            </tbody>
            <tfoot>
              <tr>
                  <th>NO. </th>
                  <th>Nama Mata Pelajaran</th>
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
