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
                        <h4 class="card-title">{{$subtitle}} {{ $title }}</h4>

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
                            <div class="row">


                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" {{ $data->type == 'detail' ? 'disabled' : '' }}
                                        value='{{ $data->nama ?? old('nama') }}'
                                        class="form-control @error('nama') is-invalid @enderror" id="nama"
                                        name="nama" required autofocus>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">NIK</label>
                                    <input type="text" {{ $data->type == 'detail' ? 'disabled' : '' }}
                                        value='{{ $data->nik ?? old('nik') }}'
                                        class="form-control @error('nik') is-invalid @enderror" id="nik"
                                        name="nik" required autofocus>
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3 ">
                                    <div class="form-check">

                                        <label for="gender" class="form-label">Jenis Kelamin</label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="gender" value="Laki-laki"
                                                {{ $data->gender == 'Laki-laki' ? 'checked' : '' }}>
                                            <span class="form-radio-sign">Laki-laki</span>
                                        </label>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="gender" value="Perempuan"
                                                {{ $data->gender == 'Perempuan' ? 'checked' : '' }}>
                                            <span class="form-radio-sign">Perempuan</span>
                                        </label>

                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Alamat</label>
                                    <input type="text" {{ $data->type == 'detail' ? 'disabled' : '' }}
                                        value='{{ $data->address ?? old('address') }}'
                                        class="form-control @error('address') is-invalid @enderror" id="address"
                                        name="address" required autofocus>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            @if ($data->type != 'detail')
                                <button type="submit" class="btn btn-primary">Simpan</button>

                            @elseif($data->type == 'edit')
                                <a href="{{ route('recipient.edit', $data->id) }}"><button type="button"
                                        class="btn btn-primary">Edit</button></a>
                            @endif
                            <a href="{{ route('recipient.index') }}"><button type="button"
                                    class="btn btn-primary btn-border ml-2">Kembali</button></a>

                        </form>
                    </div>
                </div>

                @if ($data->type == 'detail' && $data->bobot != 0)
                    <div class="card">
                        <div class="card-body">
                            <h3>Penilaian</h3>
                            <p>Hasil Keputusan : <b>{{ $data->bobot > 4 ? 'Diterima' : 'Tidak Diterima' }}</b></p>
                            <div class=" col-lg-12 mb-5">

                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Variabel</th>
                                            <th scope="col">Himpunan</th>
                                            <th scope="col">Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($evaluation as $ev)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ev->variabel->variabel }}</td>
                                                <td>{{ $ev->himpunan->himpunan }}</td>
                                                <td>{{ $ev->bobot }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- add jabatan code --}}

            </div>


        </div>
    </div>



@endsection
