@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('mesin.index') }}">Mesin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Mesin</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Ubah Mesin</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>

                    </div>
                <div class="box-body">
                  <form method="POST" action="{{ route('mesin.update', $mesin) }}">
                        @csrf
                        
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="nama" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $mesin->nama) }}" required autocomplete="nama" autofocus>

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategori" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Kategori') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control" name="kategori_id">
                                    <option value="" disabled selected></option>
                                  @foreach($kategori as $key)
                                    <option value="{{ $key->id }}" {{ old('kategori_id', $mesin->kategori_id) == $key->id ? 'selected' : '' }}>{{ $key->nama }}</option>
                                  @endforeach
                                </select>
                                @error('kategori')
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
@stop
