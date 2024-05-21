
@extends('siswa')

@section('isisiswa')
    
<div class="col-12">
  

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Materi Mata Pelajaran</h3>
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
              <th>Mata Pelajaran</th>
              <td>Aksi</td>

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
                <td>{{ $item->namamapel }}</td>
                <td>
                    <form action="{{ route("datamaterisiswa", ['idjadwal' => $item->id]) }}" method="get">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $item->idmapel }}">
                        <button type="submit" value="Tugas" name="" class="btn btn-info">Materi</button>
                    </form>
                </td>
              </tr>
  
              @endforeach
            
            </tbody>
            <tfoot>
              <tr>
                <th>NO. </th>
                <th>Mata Pelajaran</th>
                <td>Aksi</td>
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
