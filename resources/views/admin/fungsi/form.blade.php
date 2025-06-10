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
                                <label for="name" class="form-label">Himpunan</label>
                                @php
                                    $himpunanActive = $data->himpunan_id ?? old('himpunan_id');
                                @endphp
                                <select name="himpunan_id" id="" class="form-control"
                                    {{ $data->type == 'detail' ? 'disabled' : '' }} required>
                                    <option value="">Pilih Himpunan</option>
                                    @foreach ($himpunan as $g)
                                        <option {{ $himpunanActive == $g->id ? 'selected' : '' }}
                                            value="{{ $g->id }}">
                                            {{ $g->variabel->variabel . '-' . $g->himpunan }}</option>
                                    @endforeach
                                </select>
                                @error('himpunan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="mb-3">
            <label for="name" class="form-label">Variabel ID</label>
            <input type="text" {{ $data->type == 'detail' ? 'disabled' : ''}} value='{{$data->variabel_id ?? old('variabel_id')}}' class="form-control @error('variabel_id') is-invalid @enderror" id="variabel_id" name="variabel_id" required autofocus>
            @error('variabel_id')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
         </div> --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Fungsi</label>
                                <input type="text" {{ $data->type == 'detail' ? 'disabled' : '' }}
                                    value='{{ $data->fungsi ?? old('fungsi') }}'
                                    class="form-control @error('fungsi') is-invalid @enderror" id="fungsi" name="fungsi"
                                    required autofocus>
                                @error('fungsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Bobot</label>
                                <input type="text" {{ $data->type == 'detail' ? 'disabled' : '' }}
                                    value='{{ $data->bobot ?? old('bobot') }}'
                                    class="form-control @error('bobot') is-invalid @enderror" id="bobot" name="bobot"
                                    required autofocus>
                                @error('bobot')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            @if ($data->type != 'detail')
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            @elseif($data->type == 'edit')
                                <a href="{{ route('fungsi.edit', $data->id) }}"><button type="button"
                                        class="btn btn-primary">Edit</button></a>
                            @endif
                            <a href="{{ route('fungsi.index') }}"><button type="button"
                                    class="btn ml-2 btn-secondary">Kembali</button></a>

                        </form>
                    </div>
                </div>

                {{-- add jabatan code --}}

            </div>
        </div>
    </div>
    <div class="row">



    </div>
@endsection
