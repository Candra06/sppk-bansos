@extends('admin.layout.app')
@section('main')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">{{ $title }}</h4>

            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="/dashboard">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">{{ $title }}</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">{{ $subtitle }}</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Tambah Data {{ $title }}</h4>

                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ $data->route }}" enctype="multipart/form-data">
                            @if (session('failed'))
                                <div class="alert alert-danger mg-b-0" role="alert">
                                    {{ session('failed') }}
                                </div>
                            @endif
                            @csrf
                            @if ($data->type != 'create')
                                @method('PUT')
                            @endif
                            <div class="row mb-3">

                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Variabel</label>
                                    <input type="text" {{ $data->type == 'detail' ? 'disabled' : '' }}
                                        value='{{ $data->variabel ?? old('variabel') }}'
                                        class="form-control @error('variabel') is-invalid @enderror" id="variabel"
                                        name="variabel" required autofocus>
                                    @error('variabel')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Kode</label>
                                    <input type="text" {{ $data->type == 'detail' ? 'disabled' : '' }}
                                        value='{{ $data->kode ?? old('kode') }}'
                                        class="form-control @error('kode') is-invalid @enderror" id="kode"
                                        name="kode" required autofocus>
                                    @error('kode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nilai Minimal</label>
                                    <input type="text" {{ $data->type == 'detail' ? 'disabled' : '' }}
                                        value='{{ $data->min ?? old('min') }}'
                                        class="form-control @error('min') is-invalid @enderror" id="min"
                                        name="min" required autofocus>
                                    @error('min')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nilai Maksimal</label>
                                    <input type="text" {{ $data->type == 'detail' ? 'disabled' : '' }}
                                        value='{{ $data->max ?? old('max') }}'
                                        class="form-control @error('max') is-invalid @enderror" id="max"
                                        name="max" required autofocus>
                                    @error('max')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            @if ($data->type != 'detail')
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            @elseif($data->type == 'edit')
                                <a href="{{ route('variabel.edit', $data->id) }}"><button type="button"
                                        class="btn btn-primary">Edit</button></a>
                            @endif
                            <a href="{{ route('variabel.index') }}"><button type="button"
                                    class="btn btn-primary btn-border ml-3">Kembali</button></a>

                        </form>
                    </div>
                </div>

                {{-- add jabatan code --}}

            </div>
        </div>
    </div>
@endsection
