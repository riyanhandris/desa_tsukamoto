@extends('layout.v_template')


@section('content')

<div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Rekomendasi BLT</h6>
  </div>
  <div class="card-body">
        
    <a href="{{ route('print') }}" class="btn btn-primary" target="blank">Print<i class="fas fa-print"></i></a>
    <br><br>
      <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>No.</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Jenis Kelamin</th>
                      <th>Dusun</th>
                      <th>RT</th>
                      <th>RW</th>
                      <th>BLT</th>
                      <th>Hasil z</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($data as $var )
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $var->nik }}</td>
                      <td>{{ $var->nama }}</td>
                      <td>{{ $var->jk }}</td>
                      <td>{{ $var->dusun }}</td>
                      <td>{{ $var->rt }}</td>
                      <td>{{ $var->rw }}</td>
                      <td>{{ $var->blt }}</td>
                      <td>{{ $var->hasil_z }}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>

  </div>
</div>
@endsection