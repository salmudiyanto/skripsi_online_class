
@extends('guru')

@section('isiguru')
    
<div class="col-12">
  

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Kuis Pelajaran {{ $pelajaran }}</h3>
        <div class="card-tools">
            {{-- <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">Tambah</a> --}}
          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO. </th>
              <th>Kelas</th>
              <td>Jadwal Hari</td>
              <td>Jadwal Jam</td>
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
                  @php
                      $awal = strtotime($item->jampelajaran)+60*60;
                    //   $akhir = strtotime(date('H:i:s'));
                  @endphp
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->namakelas }}</td>
                <td>{{ $item->hari }}</td>
                <td>{{ $item->jampelajaran }} s/d {{ date('H:i:s', $awal) }}</td>
                <td>
                  <form action="{{ route("kuiskelas", ['idjadwal' => $item->id]) }}" method="get">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{ $item->id }}">
                      <input type="hidden" name="idmapel" value="{{ $item->idmapel }}">
                      <input type="hidden" name="idkelas" value="{{ $item->idkelas }}">
                      <button type="submit" value="Kuis" name="" class="btn btn-info">Kuis</button>
                  </form>
                </td>
              </tr>
  
              @endforeach
            
            </tbody>
            <tfoot>
              <tr>
                <th>NO. </th>
                <th>Kelas</th>
                <td>Jadwal Hari</td>
                <td>Jadwal Jam</td>
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
<script>
  tinymce.init({
    selector: '#deskripsi',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
  });
</script>
  @endsection
