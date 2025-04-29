@extends('layouts.admin') 
@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Dashboard';
</script>

<div class="container">
    @if($totalkunjunganpending > 0)
    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
        <i class="fas fa-bell fa-lg me-3"></i>
        <div class="flex-grow-1">
            @if($totalkunjunganpending == 1 && $kunjunganBaru)
                <h6 class="mb-1">Permohonan Kunjungan</h6>
                <p class="mb-0">
                    Anda memiliki 1 permohonan kunjungan dari 
                    <strong>{{ $kunjunganBaru->nama_lengkap }}</strong>. Silakan tinjau permohonan tersebut.
                </p>
            @else
                <h6 class="mb-1">Permohonan Kunjungan</h6>
                <p class="mb-0">
                    Anda memiliki <strong>{{ $totalkunjunganpending }}</strong> permohonan kunjungan yang belum diverifikasi. 
                    Mohon segera lakukan peninjauan.
                </p>
            @endif
        </div>
        <a href="{{ route('kunjungan.getAll') }}" class="btn btn-sm btn-outline-danger ms-3">
            Tinjau
        </a>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    

    <h2 class="mb-4">Beranda</h2>
    <div class="row">
        <!-- Kunjungan Card -->
        <div class="col-md-3">
            <a href="{{ route('kunjungan.getAll') }}" class="text-white text-decoration-none">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h6 class="card-title">Total Kunjungan</h6>
                        <p class="card-text" style="font-size: 30px; font-weight: bold;">{{ $totalkunjungan }}</p>
                    </div>
                    <div class="card-footer">
                        <span>Lihat Kunjungan
                            @if($totalkunjunganpending > 0)
                                <span class="badge rounded-pill bg-warning">{{ $totalkunjunganpending }}</span>
                            @endif
                        </span>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- Entitas Card -->
        <div class="col-md-3">
            <a href="{{ route('entitas.getAll') }}" class="text-white text-decoration-none">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h6 class="card-title">Total Koleksi</h6>
                        <p class="card-text" style="font-size: 30px; font-weight: bold;">{{ $totalKoleksi }}</p>
                    </div>
                    <div class="card-footer">
                        <span>Lihat Koleksi</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Stok Benih Card -->
        <div class="col-md-3">
            <a href="{{ route('benih.getAll') }}" class="text-white text-decoration-none">
                <div class="card text-white bg-brown mb-3" style="background-color: #8B4513;">
                    <div class="card-body">
                        <h6 class="card-title">Stok Benih</h6>
                        <p class="card-text" style="font-size: 30px; font-weight: bold;">{{ $totalstokbenih }}</p>
                    </div>
                    <div class="card-footer">
                        <span>Lihat Stok Benih</span>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- Testimoni Card -->
        <div class="col-md-3">
            <a href="{{ route('admin.testimoni.index') }}" class="text-white text-decoration-none">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h6 class="card-title">Total Ulasan</h6>
                        <p class="card-text" style="font-size: 30px; font-weight: bold;">{{ $totaltestimoni }}</p>
                    </div>
                    <div class="card-footer">
                        <span>Lihat Testimoni 
                            @if($totaltestimonipending > 0)
                                <span class="badge rounded-pill bg-warning">{{ $totaltestimonipending }}</span>
                            @endif
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-danger text-white">
            Grafik Data Kunjungan per Bulan (Terverifikasi)
        </div>
        <div class="card-body">
            <div style="height: 300px;">
                <canvas id="kunjunganChart"></canvas>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            Grafik Jenis Tanaman
        </div>
        <div class="card-body">
            <div style="height: 300px;">
                <canvas id="jenisTanamanChart"></canvas>
            </div>
        </div>
    </div>
</div>




<style>
    .chart-canvas {
        width: 100% !important;
        height: 300px !important;
    }
</style>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const kunjunganPerBulan = @json($kunjunganPerBulanLengkap); 
    const ctxKunjungan = document.getElementById('kunjunganChart').getContext('2d');
    const kunjunganChart = new Chart(ctxKunjungan, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: kunjunganPerBulan,
                backgroundColor: 'rgba(54, 162, 235, 0.1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    min: 0,
                    max: 20,
                    ticks: {
                        stepSize: 2
                    },
                    grid: {
                        color: 'rgba(200, 200, 200, 0.2)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            }
        }
    });
</script>


</script>

<!-- Kode untuk Pie Chart Jenis Tanaman -->
<script>
const jenisTanamanData = @json($jenisTanamanData);

const ctxJenis = document.getElementById('jenisTanamanChart').getContext('2d');
new Chart(ctxJenis, {
    type: 'doughnut',
    data: {
        labels: Object.keys(jenisTanamanData),
        datasets: [{
            label: 'Jumlah Entitas',
            data: Object.values(jenisTanamanData),
            backgroundColor: [
                '#4CAF50', '#FF9800', '#03A9F4', '#E91E63', '#9C27B0', '#00BCD4', '#CDDC39', '#FF5722'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'bottom'
            },
            tooltip: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.parsed;
                        const total = context.chart._metasets[0].total;
                        const percent = ((value / total) * 100).toFixed(1);
                        return `${label}: ${value} entitas (${percent}%)`;
                    },
                    title: () => null  // Hilangkan judul atas tooltip
                }
            }
        }
    }
});

</script>

@endsection
