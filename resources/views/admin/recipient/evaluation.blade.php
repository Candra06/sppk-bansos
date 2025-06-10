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
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" readonly value='{{ $data->data->nama }}'
                                    class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                                    required autofocus>
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @foreach ($data->variabel as $item)
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Kriteria</label>
                                        <input type="text" readonly value='{{ $item['variabel'].'('.$item['variabel_kode'].')' }}' class="form-control"
                                            autofocus>
                                        <input type="hidden" name="variabel_id[]" value="{{ $item['id'] }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nilai</label>
                                        <select name="nilai[]" class="form-control" id="">
                                            <option value="">Pilih Penilaian</option>
                                            @foreach ($item['himpunan'] as $it)
                                                <option value="{{$it['id']}}">{{$it['himpunan']}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" class="form-control" name="nilai[]"
                                            placeholder="Nilai Variabel" autofocus> --}}
                                    </div>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary">Simpan</button>

                            <a href="{{ route('recipient.index') }}"><button type="button"
                                    class="btn btn-primary btn-border">Kembali</button></a>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
