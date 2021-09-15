@extends('layout.v_template')

@section('content')

@if (session('pesan'))
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-check"></i>Sukses</h5>
    {{ session('pesan') }}
  </div>
    
@endif

@if ($errors->any())
<div class="alert alert-info alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h5><i class="icon fa fa-check"></i>Gagal</h5>
  {{-- <ul>
    @foreach ($errors->all() as $item)
        <li>{{ $item }}</li>
    @endforeach
  </ul> --}}
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Warga</h6>
    </div>
    <div class="card-body">
        <a href="" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#mymodal">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah</span>
        </a><br><br>
        <div class="modal fade" id="mymodal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah data warga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="/warga/insert" method="POST">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                      <label>NIK</label>
                      <input type="number" name="nik" class="form-control" value="{{ old('nik') }}" placeholder="NIK">
                      {{-- <div class="text-danger">
                          @error('nik')
                             {{ $message }}
                          @enderror
                      </div> --}}
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
                    <select name="jk" class="form-control select2 select2-danger"value="{{ old('jk') }}" data-dropdown-css-class="select2-danger" style="width: 100%;">
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
                  <div class="form-group">
                    <label>Dusun</label>
                    <input type="text" name="dusun" class="form-control" value="{{ old('dusun') }}" placeholder="Dusun">
                    <div class="text-danger">
                      @error('dusun')
                         {{ $message }}
                      @enderror
                  </div>
                  </div>
                  <div class="form-group">
                    <label>RT</label>
                    <input type="number" name="rt" class="form-control" value="{{ old('rt') }}" placeholder="RT">
                    <div class="text-danger">
                      @error('rw')
                         {{ $message }}
                      @enderror
                  </div>
                  </div>
                  <div class="form-group">
                    <label>RW</label>
                    <input type="number" name="rw" class="form-control" value="{{ old('rw') }}" placeholder="RW">
                    <div class="text-danger">
                      @error('rw')
                         {{ $message }}
                      @enderror
                  </div>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}" class="form-control">
                  </div>
                </div>
                <!-- /.card-body -->
               
              
              </div>
              <div class="modal-footer justify-content-between">
                {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
       
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Dusun</th>
                        <th>RT</th>
                        <th>RW</th>
                        {{-- <th>Petugas</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($warga as $data )
                    <tr>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->jk }}</td>
                        <td>{{ $data->dusun }}</td>
                        <td>{{ $data->rt }}</td>
                        <td>{{ $data->rw }}</td>
                        {{-- <td>Petugas</td> --}}
                        <td><a href="/warga/detail/{{ $data->id_warga }}" class="btn btn-sm btn-success">Detail</a>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal2{{ $data->id_warga }}">Edit</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger{{ $data->id_warga }}">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @foreach($warga as $data)
                  
                
        <!-- Modal edit warga -->
        <div class="modal fade" id="myModal2{{ $data->id_warga }}" role="dialog">
         <div class="modal-dialog">

             <!-- Modal content-->
             <div class="container-fluid">
                 <div class="row">
                   <!-- left column -->
                   <div class="col-md-12">
                     <!-- jquery validation -->
                     <div class="modal-content"> <div class="card card-primary">
                         <div class="modal-header">
                           <h4>Ubah Data Warga</h4>
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form action="/warga/update/{{ $data->id_warga }}" method="POST">
                             @csrf
                           <div class="card-body">
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
                               <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" placeholder="Nama">
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
                             <div class="form-group">
                               <label>Dusun</label>
                               <input type="text" name="dusun" class="form-control" value="{{ $data->dusun }}" placeholder="Dusun">
                               <div class="text-danger">
                                 @error('dusun')
                                    {{ $message }}
                                 @enderror
                             </div>
                             </div>
                             <div class="form-group">
                               <label>RT</label>
                               <input type="number" name="rt" class="form-control" value="{{ $data->rt }}" placeholder="RT">
                               <div class="text-danger">
                                 @error('rt')
                                    {{ $message }}
                                 @enderror
                             </div>
                             </div>
                             <div class="form-group">
                               <label>RW</label>
                               <input type="number" name="rw" class="form-control" value="{{ $data->rw }}" placeholder="RW">
                               <div class="text-danger">
                                 @error('rw')
                                    {{ $message }}
                                 @enderror
                             </div>
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
     @endforeach

     @foreach ($warga as $data )
     <div class="modal fade" id="modal-danger{{ $data->id_warga }}">
       <div class="modal-dialog">
         <div class="modal-content bg-danger">
           <div class="modal-header">
             <h4 style="color: whitesmoke;" class="modal-title">Menghapus Data</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <p style="color: whitesmoke;">Apakah anda yakin ingin menghapus data dari NIK "{{ $data->nik }}({{ $data->nama }})" ?</p>
           </div>
           <div class="modal-footer justify-content-between">
             <button type="button" class="btn btn-outline-light" data-dismiss="modal">TIDAK</button>
             <a href="/warga/delete/{{ $data->id_warga }}" class="btn btn-outline-light">YA</a>
           </div>
         </div>
         <!-- /.modal-content -->
       </div>
       <!-- /.modal-dialog -->
     </div>
     <!-- /.modal -->
     @endforeach
    </div>
</div>
@endsection