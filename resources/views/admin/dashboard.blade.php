@extends('layouts.admin') 
@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Dashboard';
</script>

<div class="container">
    <h2 class="mb-4">Dashboard</h2>
    <div class="row">
        <!-- Kunjungan Card -->
        <div class="col-md-4">
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
        <div class="col-md-4">
            <a href="{{ route('entitas.getAll') }}" class="text-white text-decoration-none">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h6 class="card-title">Total Koleksi Tanaman</h6>
                        <p class="card-text" style="font-size: 30px; font-weight: bold;">{{ $totalKoleksiTanaman }}</p>
                    </div>
                    <div class="card-footer">
                        <span>Lihat Koleksi</span>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- Testimoni Card -->
        <div class="col-md-4">
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
</div>

<div class="container mt-4">
    
    <div class="row">
        <div class="col-md-6">
            <h5 class="text-center">Kunjungan per Bulan</h5>
            <canvas id="kunjunganChart" width="100%" height="100px"></canvas>
        </div>

        <div class="col-md-6">
            <h5 class="text-center">Data per Jenis Tanaman</h5>
            <canvas id="jenisTanamanChart" width="100%" height="100px"></canvas>
        </div>
    </div>
</div>

<!-- Tambahkan Chart.js dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Kode untuk Bar Chart Kunjungan -->
<script>
    var ctxKunjungan = document.getElementById('kunjunganChart').getContext('2d');
    var kunjunganPerBulan = @json(array_values($kunjunganPerBulanLengkap));

    var kunjunganChart = new Chart(ctxKunjungan, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: kunjunganPerBulan,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 20
                }
            }
        }
    });
</script>

<!-- Kode untuk Pie Chart Jenis Tanaman -->
<script>
    var ctxJenis = document.getElementById('jenisTanamanChart').getContext('2d');
    var jenisTanamanLabels = @json(array_keys($jenisTanamanData));
    var jenisTanamanValues = @json(array_values($jenisTanamanData));

    var jenisTanamanChart = new Chart(ctxJenis, {
        type: 'pie',
        data: {
            labels: jenisTanamanLabels,
            datasets: [{
                label: 'Jumlah Jenis Tanaman',
                data: jenisTanamanValues,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Jenis Tanaman'
                }
            }
        }
    });
</script>

@endsection
