@extends('admin.layout.app')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
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
                                    <label for="name" class="form-label">Variabel</label>
                                    <input type="text" readonly value='{{ $item->variabel }}' class="form-control"
                                        autofocus>
                                    <input type="hidden" name="variabel_id[]" value="{{ $item->id }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nilai</label>
                                    <input type="text" class="form-control" name="nilai[]" placeholder="Nilai Variabel" autofocus>
                                </div>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Simpan</button>

                        <a href="{{ route('employee.index') }}"><button type="button"
                                class="btn btn-dark">Kembali</button></a>

                    </form>
                </div>
            </div>

            {{-- add jabatan code --}}

        </div>
    </div>
@endsection
