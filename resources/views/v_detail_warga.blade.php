@extends('layout.v_template')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Warga</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                
                                        <tr><th >NIK</th>
                                            <th>:</th>
                                            <th>{{ $warga->nik }}</th>
                                        </tr>
                                        <tr><th>Nama</th>
                                            <th>:</th>
                                            <th>{{ $warga->nama }}</th>
                                        </tr>
                                        <tr><th>Jenis Kelamin</th>
                                            <th>:</th>
                                            <th>{{ $warga->jk }}</th>
                                        </tr>
                                        <tr><th>Dusun</th>
                                            <th>:</th>
                                            <th>{{ $warga->dusun }}</th>
                                        </tr>
                                        <tr><th>RT</th>
                                            <th>:</th>
                                            <th>{{ $warga->rt }}</th>
                                        </tr>
                                        <tr><th>RW</th>
                                            <th>:</th>
                                            <th>{{ $warga->rw }}</th>
                                        </tr>
                                    </table>
        </div>
    </div>
</div>
@endsection