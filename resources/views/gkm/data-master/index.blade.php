@extends('layouts.app')

@section('page-title', 'Data Master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-people" style="font-size: 40px; color: #1e3c72;"></i>
                    <h6 class="mt-3 mb-2">Data Dosen TRPL</h6>
                    <p class="text-muted small mb-3">Kelola daftar dosen pengajar</p>
                    <a href="{{ route('gkm.data-master.dosen') }}" class="btn btn-primary btn-sm">Kelola Dosen</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-book" style="font-size: 40px; color: #ffc107;"></i>
                    <h6 class="mt-3 mb-2">Data Mata Kuliah Ajaran</h6>
                    <p class="text-muted small mb-3">Kelola daftar mata kuliah</p>
                    <a href="{{ route('gkm.data-master.matakuliah') }}" class="btn btn-warning btn-sm">Kelola Mata Kuliah</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-calendar" style="font-size: 40px; color: #6f42c1;"></i>
                    <h6 class="mt-3 mb-2">Data Periode Akademik</h6>
                    <p class="text-muted small mb-3">Kelola periode semester akademik</p>
                    <a href="#" class="btn btn-secondary btn-sm">Kelola Periode</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-file-text" style="font-size: 40px; color: #20c997;"></i>
                    <h6 class="mt-3 mb-2">Template Laporan Materi</h6>
                    <p class="text-muted small mb-3">Kelola template laporan</p>
                    <a href="{{ route('gkm.data-master.template') }}" class="btn btn-success btn-sm">Kelola Template</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-file-earmark-spreadsheet" style="font-size: 40px; color: #17a2b8;"></i>
                    <h6 class="mt-3 mb-2">Template Laporan Kuisioner</h6>
                    <p class="text-muted small mb-3">Kelola template untuk laporan kuisioner mahasiswa</p>
                    <a href="#" class="btn btn-info btn-sm">Kelola Template</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
