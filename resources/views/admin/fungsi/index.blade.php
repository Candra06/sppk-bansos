@extends('admin.layout.app')



@section('main')
    <div class="page-inner">
        @if (session()->has('success'))
            <div class="alert alert-success col-lg-12" role="alert">
                {{ session('success') }}
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
                            <a href="{{ route('fungsi.create') }}" class="btn btn-primary btn-md">+ Tambah Data</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Variabel</th>
                                        <th scope="col">Himpunan</th>
                                        <th scope="col">Fungsi</th>
                                        <th scope="col">Bobot</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->himpunan->variabel->variabel }}</td>
                                            <td>{{ $item->himpunan->himpunan }}</td>
                                            <td>{{ $item->fungsi }}</td>
                                            <td>{{ $item->bobot }}</td>
                                            <td>
                                                @if (auth()->user()->role == 'Admin')
                                                    <a href="{{ route('fungsi.edit', $item->id) }}"
                                                        class="btn btn-md btn-success"><i class="fas fa-edit"></i> Edit</a>
                                                    <form action="{{ route('fungsi.destroy', $item->id) }}" method="post"
                                                        class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-md btn-danger"
                                                            onclick="return confirm ('Are you sure ?')"><i class="fas fa-trash"></i> Delete</button>
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
