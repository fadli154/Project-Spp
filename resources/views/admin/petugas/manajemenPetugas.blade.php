@extends('layouts.main')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex">
                    <div class="col-md-9 col-sm-8">
                        <h4 class="text-dark">Manajemen Petugas</h4>
                    </div>
                    <div class="col-md-3 col-sm-4 text-center items-center mt-2 ">
                        <div class="breadcrumb-item d-inline active"><a href="#">Dashboard</a></div>
                        <div class="breadcrumb-item d-inline">Petugas</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-11 col-sm">
                            <h4 class="text-primary">Petugas</h4>
                        </div>
                        <div class="col-lg-1 col-sm d-flex justify-content-end">
                            <button class="btn btn-primary">
                                <i class="bi bi-patch-plus btn-tambah-data"></i><span class="p-2">Tambah
                                    Data</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                @foreach ($users as $data)
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Akses</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="capitalize">{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->level }}</td>
                                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                    </tbody>
                                @endforeach
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
