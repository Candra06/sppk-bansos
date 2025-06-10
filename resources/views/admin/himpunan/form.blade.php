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
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="name" class="form-label">Variabel</label>
                                    @php
                                        $variabelActive = $data->variabel_id ?? old('variabel_id');
                                    @endphp
                                    <select name="variabel_id" id="" class="form-control"
                                        {{ $data->type == 'detail' ? 'disabled' : '' }} required>
                                        <option value="">Pilih variabel</option>
                                        @foreach ($variabel as $g)
                                            <option {{ $variabelActive == $g->id ? 'selected' : '' }}
                                                value="{{ $g->id }}">
                                                {{ $g->variabel }}</option>
                                        @endforeach
                                    </select>
                                    @error('variabel_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="name" class="form-label">Himpunan</label>
                                    <input type="text" {{ $data->type == 'detail' ? 'disabled' : '' }}
                                        value='{{ $data->himpunan ?? old('himpunan') }}'
                                        class="form-control @error('himpunan') is-invalid @enderror" id="himpunan"
                                        name="himpunan" required autofocus>
                                    @error('himpunan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            @if ($data->type != 'detail')
                                <button type="submit" class="btn btn-primary">Simpan</button>

                            @elseif($data->type == 'edit')
                                <a href="{{ route('himpunan.edit', $data->id) }}"><button type="button"
                                        class="btn btn-primary">Edit</button></a>
                            @endif
                            <a href="{{ route('himpunan.index') }}"><button type="button"
                                    class="btn btn-primary btn-border ml-2">Kembali</button></a>

                        </form>
                    </div>
                </div>

                {{-- add jabatan code --}}

            </div>

        </div>
    </div>
@endsection
