@extends('layouts.app')

@section('page-title', 'Template Laporan Materi')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Template Laporan Materi</h5>
            <button class="btn btn-primary btn-sm">+ Upload Template</button>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Template</th>
                            <th>Jenis File</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Template_Laporan_Materi_Revisi_2026.docx</td>
                            <td>DOCX</td>
                            <td>01-02-2026</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Template_Laporan_Materi_2025.docx</td>
                            <td>DOCX</td>
                            <td>05-01-2026</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
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
