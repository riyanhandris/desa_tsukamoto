@extends('layout.v_template')

@section('content')
<div class="container-fluid">
 <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <table class="table" style="border: 0;">
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
</div>
@endsection