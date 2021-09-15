@extends('layout.v_template')


@section('content')
@if (session('pesan'))
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-check"></i><br>Sukses</h5>
    {{ session('pesan') }}
  </div>  
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h5><i class="icon fas fa-exclamation-triangle"></i><br>Data gagal dimasukkan</h5>
  <p>Coba periksa data yang anda masukkan</p>
  {{-- <ul>
    @foreach ($errors->all() as $item)
        <li>{{ $item }}</li>
    @endforeach
  </ul> --}}
</div>
@endif

@if (session('pesan2'))
<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h5><i class="icon fa fa-check"></i><br>Berhasil</h5>
  {{ session('pesan2') }}
</div> 
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Petugas</h6>
    </div>
    <div class="card-body">
        <a href="" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#myModal">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah</span>
        </a><br><br>

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="container-fluid">
                    <div class="row">
                      <!-- left column -->
                      <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="modal-content"> <div class="card card-primary">
                            <div class="modal-header">
                              <h4>Tambah Data Petugas</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/petugas/insert" method="POST">
                                @csrf
                              <div class="card-body">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="number" name="nik" class="form-control" value="{{ old('nik') }}" placeholder="NIK">
                                    <div class="text-danger">
                                      @error('nik')
                                         {{ $message }}
                                      @enderror
                                  </div>
                                  </div>
                                <div class="form-group">
                                  <label>Nama</label>
                                  <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Nama">
                                  <div class="text-danger">
                                    @error('nama')
                                       {{ $message }}
                                    @enderror
                                </div>
                                </div>
                                <div class="form-group">
                                  <label>Jenis Kelamin</label>
                                  <select name="jk" class="form-control select2 select2-danger" value="{{ old('jk') }}" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option disabled selected>Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                  </select>
                                </div>
                                <div class="text-danger">
                                  @error('jk')
                                     {{ $message }}
                                  @enderror
                              </div>
    
                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                            </form>
                          </div></div>
                       
                        <!-- /.card -->
                        </div>
                      <!--/.col (left) -->
                      <!-- right column -->
                      <div class="col-md-6">
            
                      </div>
                      <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                  </div><!-- /.container-fluid -->
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($petugas as $data )
                    <tr>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->jk }}</td>
                        <td> <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal2{{ $data->id }}">Edit</button>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger{{ $data->id }}">Hapus</button>
                  </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($petugas as $data)
<div class="modal fade" id="myModal2{{ $data->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah data petugas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/petugas/update/{{ $data->id }}" method="POST">
          @csrf
          <div class="form-group">
              <label>NIK</label>
              <input type="number" name="nik" class="form-control" value="{{ $data->nik }}" readonly placeholder="NIK">
              <div class="text-danger">
                  @error('nik')
                     {{ $message }}
                  @enderror
              </div>
            </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $data->name }}" placeholder="Nama">
            <div class="text-danger">
              @error('nama')
                 {{ $message }}
              @enderror
          </div>
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jk" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
              <option selected>{{ $data->jk }}</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="text-danger">
              @error('jk')
                 {{ $message }}
              @enderror
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

@foreach ($petugas as $data )
<div class="modal fade" id="modal-danger{{ $data->id }}">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 style="color: whitesmoke;" class="modal-title">Menghapus Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="color: whitesmoke;">Apakah anda yakin ingin menghapus data dari NIK "{{ $data->nik }}({{ $data->name }})" ?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">TIDAK</button>
        <a href="/petugas/delete/{{ $data->id }}" class="btn btn-outline-light">YA</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach
@endsection