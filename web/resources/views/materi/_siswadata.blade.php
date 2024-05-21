
@extends('siswa')

@section('isisiswa')
    
<div class="col-12">
  

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
                <td><a href="{{ route('filemateridetail', ['id' =>  $item->idmateri]) }}" target="_blank" rel="noopener noreferrer" class="btn btn-success">Buka Materi</a></td>
              </tr>
  
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
    selector: '#deskripsi',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
  });
</script>
  @endsection
