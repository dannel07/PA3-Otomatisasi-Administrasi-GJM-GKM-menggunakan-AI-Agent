@extends('layouts.app')

@section('page-title', 'Monitoring RPS & Materi')

@section('content')
<div style="padding: 1.5rem;">
    <h4 class="mb-4">MONITORING MATERI & RPS</h4>

    <p class="text-muted mb-3">Periode: {{ date('F Y') }} - Minggu ke-4</p>

    <!-- Filter Dosen -->
    <div class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <form method="GET" class="d-flex gap-2">
                    <select name="dosen_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Cari dosen atau mata kuliah...</option>
                        @foreach($dosenList as $dos)
                            <option value="{{ $dos->id }}" @if(request('dosen_id') == $dos->id) selected @endif>
                                {{ $dos->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('gkm.monitoring-rps.ceklist') }}" class="btn btn-primary">
                    Kirim Reminder ke yang Belum Upload
                </a>
            </div>
        </div>
    </div>

    <!-- Table Dosen per Mata Kuliah -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Dosen</th>
                            <th>Mata Kuliah</th>
                            <th>Status Upload Materi</th>
                            <th>Status RPS</th>
                            <th>History Reminder</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dosenList as $i => $dos)
                            <tr>
                                <td>{{ $dosenList->firstItem() + $i }}</td>
                                <td>
                                    <strong>{{ $dos->nama_lengkap }}</strong><br>
                                    <small class="text-muted">{{ $dos->kontak_email }}</small>
                                </td>
                                <td>
                                    @if($dos->matakuliah && $dos->matakuliah->count() > 0)
                                        @foreach($dos->matakuliah->take(2) as $mk)
                                            <span class="badge bg-secondary">{{ $mk->nama_mk }}</span>
                                        @endforeach
                                        @if($dos->matakuliah->count() > 2)
                                            <span class="badge bg-light text-dark">+{{ $dos->matakuliah->count() - 2 }} lainnya</span>
                                        @endif
                                    @else
                                        <span class="text-muted">Belum ada mata kuliah</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-warning">⊙</span>
                                </td>
                                <td>
                                    <span class="badge bg-warning">Belum Upload</span>
                                </td>
                                <td>
                                    <a href="{{ route('gkm.monitoring-rps.history', ['dosenId' => $dos->id]) }}" class="btn btn-sm btn-outline-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Tidak ada data dosen</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $dosenList->links() }}
            </div>
        </div>
    </div>

    <!-- Legend -->
    <div class="mt-3 d-flex gap-3">
        <small>
            <span class="badge bg-success">✓</span> Lengkap
        </small>
        <small>
            <span class="badge bg-warning">⊙</span> Sedang Proses
        </small>
        <small>
            <span class="badge bg-danger">✕</span> Belum Lengkap
        </small>
    </div>
</div>
@endsection
