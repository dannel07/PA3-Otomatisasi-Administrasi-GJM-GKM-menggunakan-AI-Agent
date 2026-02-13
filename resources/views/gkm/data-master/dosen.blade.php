@extends('layouts.app')

@section('page-title', 'Data Dosen Pengajar TRPL')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Dosen Pengajar TRPL</h5>
            <button class="btn btn-primary btn-sm">+ Tambah Dosen</button>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Dosen</th>
                            <th>Email</th>
                            <th>NIDN</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Andi, S.Kom</td>
                            <td>andi@example.com</td>
                            <td>1234567890</td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary">Edit</button>
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Heru, M.Cs</td>
                            <td>heru.rium@example.com</td>
                            <td>1234567891</td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary">Edit</button>
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
