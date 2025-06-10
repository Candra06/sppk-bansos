@extends('admin.layout.app')

@section('main')
    <div class="page-inner">
        @if (session()->has('success'))
            <div class="alert alert-success col-lg-12" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger col-lg-12" role="alert">
                {{ session('error') }}
            </div>
        @endif
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">List {{ $title }}</h4>
                        @if (auth()->user()->role == 'Admin')
                            <a href="{{ route('recipient.create') }}" class="btn btn-primary btn-md">+ Tambah Data</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>
                                                @if (auth()->user()->role == 'Admin')
                                                    <a href="{{ route('recipient.edit', $item->id) }}"
                                                        class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Edit</a>
                                                    <a href="{{ route('recipient.show', $item->id) }}"
                                                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                                    @if ($item->bobot == 0)
                                                        <a href="{{ url('evaluasi/' . $item->id) }}"
                                                            class="btn btn-sm btn-warning">Evaluasi</a>
                                                    @endif
                                                    <form action="{{ route('recipient.destroy', $item->id) }}"
                                                        method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm ('Are you sure ?')"><i
                                                                class="fas fa-trash"></i> Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
