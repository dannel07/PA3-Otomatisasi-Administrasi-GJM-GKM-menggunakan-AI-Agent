@extends('layouts.app')

@section('page-title', 'Monitoring RPS & Materi')

@section('content')
<div class="container-fluid">
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
                                {{ $dos->nama_dosen }}
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
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    <strong>{{ $dos->nama_dosen }}</strong><br>
                                    <small class="text-muted">{{ $dos->email_dosen }}</small>
                                </td>
                                <td>
                                    @if($dos->matakuiah->count() > 0)
                                        {{ $dos->matakuiah->first()->nama_mk }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-success">✓</span>
                                    <span class="badge bg-danger">✕</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">Lengkap</span>
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
                <small class="text-muted">Menampilkan Data 1 sampai 5 dari total 18</small>
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
