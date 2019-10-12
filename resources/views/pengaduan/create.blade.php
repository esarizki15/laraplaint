@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pengaduan.index') }}">Pengaduan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Buat Pengaduan</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Buat Pengaduan</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>

                    </div>
                <div class="box-body">
                  <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" value="{{ Auth::id() }}" name="user_id">
                        
                        <div class="form-group row">
                            <label for="lokasi" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Lokasi') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control" name="lokasi_id">
                                  <option value="" disabled selected></option>
                                  @foreach($lokasi as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                  @endforeach
                                </select>

                                @error('lokasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mesin" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Mesin') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control" name="mesin_id">
                                  <option value="" disabled selected></option>
                                  @foreach($mesin as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                  @endforeach
                                </select>

                                @error('mesin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Foto') }}</label>
 
                            <div class="col-md-6">
                                <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{ old('foto') }}" autocomplete="foto" required autofocus onchange="openFile(event)">
                                <center>
                                <img id="output" class="img-rounded img-responsive " style="width: 20rem; height: 20rem"></center>
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="Keterangan" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Keterangan') }}</label>

                            <div class="col-md-6">
                                <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}" autocomplete="keterangan" autofocus></textarea>
                                
                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 col-md-offset-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
                    </form>

        </div>
    </div>
</div>
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
    <script>
        $(document).ready(function() {
            $("#output").hide();
        });
        var openFile = function(event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function(){
          var dataURL = reader.result;
          var output = document.getElementById('output');
          output.src = dataURL;
          $("#output").show();
        };
        reader.readAsDataURL(input.files[0]);
      };
    </script>
@stop
