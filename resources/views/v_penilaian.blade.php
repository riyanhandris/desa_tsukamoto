@extends('layout.v_template')


@section('content')
<h1>Penilaian</h1>

@if (session('pesan'))
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-check"></i>Sukses</h5>
    {{ session('pesan') }}
  </div>
    
@endif

<div class="container">
    <form action="/penilaian/insert" method="POST">
        @csrf
        <div class="mb-3">
          <label class="form-label">Nomor Induk Keluarga</label>
          <input type="number" name="nik" class="form-control" value="{{ old('nik') }}">
          <div class="text-danger">
            @error('nik')
               {{ $message }}
            @enderror
        </div>
        </div>

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
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


 </div>
    {{-- Table --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekomendasi BLT</h6>
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
                            <td>{{ $data->penghasilan }}</td>
                            <td>{{ $data->keluarga }}</td>
                            <td>
                              <button type="button" class="btn btn-danger">Hapus</button>
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

                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      {{-- //Modal tambah  --}}
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