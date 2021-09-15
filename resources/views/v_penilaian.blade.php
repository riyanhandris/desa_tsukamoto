@extends('layout.v_template')


@section('content')

@if (session('pesan'))
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-check"></i>Sukses</h5>
    {{ session('pesan') }}
  </div>
    
@endif

    {{-- Table --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Nilai</h6>
        </div>
        <div class="card-body">
            <a href="" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#mymodal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Input nilai</span>
            </a><br><br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Bantuan</th>
                            <th>Penghasilan</th>
                            <th>Keluarga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penilaian as $data )
                        <tr>
                            <td>{{ $data->nik }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->bantuan }}</td>
                            <td>Rp. {{ $data->penghasilan }}</td>
                            <td>{{ $data->keluarga }}</td>
                            <td>
                              <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal2{{ $data->id_nilai }}">Edit</button>
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger{{ $data->id_nilai }}">Hapus</button>
                            </td>
                        </tr>
                        @endforeach   
                    </tbody>
                </table>
            </div>
      
        </div>
      </div>
      {{-- //Table  --}}

      {{-- Modal tambah --}}
      <div class="modal fade" id="mymodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Masukkan nilai</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="/penilaian/insert" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label">Nomor Induk Keluarga</label>
                      <input id="nikForm" type="number" name="nik" class="form-control" value="{{ old('nik') }}">
                      <div class="text-danger">
                        @error('nik')
                           {{ $message }}
                        @enderror
                    </div>
                    </div>
            
                    <div id="result"></div>
            
                    <div class="mb-3">
                        <label class="form-label">Jumlah bantuan</label>
                        <input type="number" name="bantuan" class="form-control">
                        <div class="text-danger">
                            @error('bantuan')
                               {{ $message }}
                            @enderror
                        </div>
                      </div>
            
                      <div class="mb-3">
                        <label class="form-label">Penghasilan</label>
                        <input type="number" name="penghasilan" class="form-control">
                        <div class="text-danger">
                            @error('penghasilan')
                               {{ $message }}
                            @enderror
                        </div>
                      </div>
            
                      <div class="mb-3">
                        <label class="form-label">Beban Keluarga</label>
                        <input type="number" name="keluarga" class="form-control">
                        <div class="text-danger">
                            @error('keluarga')
                               {{ $message }}
                            @enderror
                        </div>
                      </div>

                      <div class="form-group">
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}" class="form-control">
                      </div>

                
            </div>
            <div class="modal-footer justify-content-between">
              {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
              <button type="submit" class="btn btn-primary" >Simpan</button>
            </div>
        </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      {{-- //Modal tambah  --}}

            {{-- Modal edit --}}
            @foreach($penilaian as $data)
            <div class="modal fade" id="myModal2{{ $data->id_nilai }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Ubah nilai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <form action="/penilaian/update/{{ $data->id_nilai }}" method="POST">
                          @csrf
                          <div class="mb-3">
                            <label class="form-label">Nomor Induk Keluarga</label>
                            <input id="nikForm" type="number" name="nik" class="form-control" value="{{ $data->nik }}" readonly>
                            <div class="text-danger">
                              @error('nik')
                                 {{ $message }}
                              @enderror
                          </div>
                          </div>
                  
                          <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" readonly>
                            <div class="text-danger">
                                @error('nama')
                                   {{ $message }}
                                @enderror
                            </div>
                          </div>
                  
                          <div class="mb-3">
                              <label class="form-label">Jumlah bantuan</label>
                              <input type="number" name="bantuan" class="form-control" value="{{ $data->bantuan }}" placeholder="Bantuan">
                              <div class="text-danger">
                                  @error('bantuan')
                                     {{ $message }}
                                  @enderror
                              </div>
                            </div>
                  
                            <div class="mb-3">
                              <label class="form-label">Penghasilan</label>
                              <input type="number" name="penghasilan" class="form-control" value="{{ $data->penghasilan }}" placeholder="Penghasilan">
                              <div class="text-danger">
                                  @error('penghasilan')
                                     {{ $message }}
                                  @enderror
                              </div>
                            </div>
                  
                            <div class="mb-3">
                              <label class="form-label">Beban Keluarga</label>
                              <input type="number" name="keluarga" class="form-control" value="{{ $data->keluarga }}" placeholder="keluarga">
                              <div class="text-danger">
                                  @error('keluarga')
                                     {{ $message }}
                                  @enderror
                              </div>
                            </div>
      
                      
                  </div>
                  <div class="modal-footer justify-content-between">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
              </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            @endforeach
            {{-- //Modal edit  --}}

            
{{-- Modal hapus nilai --}}
@foreach ($penilaian as $data )
<div class="modal fade" id="modal-danger{{ $data->id_nilai }}">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 style="color: whitesmoke;" class="modal-title">Menghapus Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="color: whitesmoke;">Apakah anda yakin ingin menghapus Penilaian dari NIK "{{ $data->nik }}({{ $data->nama }})" ?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">TIDAK</button>
        <a href="/penilaian/delete/{{ $data->id_nilai }}" class="btn btn-outline-light">YA</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach
{{-- //modal hapus nilai --}}

@endsection


{{-- jQuery --}}
@section('script')
<script>
    $(document).ready(function(){
        $( "#nikForm" ).focusout(function() {
            let nik = $(this).val();

            $.get('{{ route('penilaian.findNIK') }}', {nik:nik}, function(data){
                $('#result').html(data)
            })
        });
    });
</script>
@endsection