
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
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Jadwal</h3>
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
            <th>Jadwal</th>
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
                <form action="{{ route('datajadwalkelas') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idkelas" value="{{ $item->id }}">
                    <button type="submit" class="btn btn-info">Jadwal</button>
                </form>
              </td>
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
