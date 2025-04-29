@extends('layouts.timkerja') 
@section('content')

<script>
    document.title += ' | Dashboard';
</script>

<div class="container">
    <h2>Beranda</h2>
    @if($totalKunjunganBelumDisetujui > 0)
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
            <i class="fas fa-bell fa-lg me-3"></i>
            <div class="flex-grow-1">
                @if($totalKunjunganBelumDisetujui == 1)
                    <h6 class="mb-1">Permohonan Kunjungan</h6>
                    <p class="mb-0">
                        Anda memiliki 1 permohonan kunjungan dari 
                        <strong>{{ $kunjunganBelumDisetujui->nama_lengkap }}</strong> yang menunggu persetujuan Anda.
                    </p>
                @else
                    <h6 class="mb-1">Permohonan Kunjungan</h6>
                    <p class="mb-0">
                        Anda memiliki <strong>{{ $totalKunjunganBelumDisetujui }}</strong> permohonan kunjungan yang perlu segera ditindaklanjuti. 
                        Mohon segera lakukan peninjauan.
                    </p>
                @endif
            </div>
                <a href="{{ route('timkerja.kunjungan.index') }}" class="btn btn-sm btn-outline-danger ms-3">
                    Tinjau
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            Grafik Kunjungan per Bulan
        </div>
        <div class="card-body">
            <div style="height: 300px;">
                <canvas id="kunjunganChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const kunjunganPerBulan = @json($dataKunjunganLengkap); 
    const ctxKunjungan = document.getElementById('kunjunganChart').getContext('2d');
    const kunjunganChart = new Chart(ctxKunjungan, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Kunjungan',
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
@endsection