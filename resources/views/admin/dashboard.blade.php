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
                        <p class="card-text" style="font-size: 30px; font-weight: bold;">
                            {{ $totaltestimoni }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <span>Lihat Testimoni 
                            @if($totaltestimonipending > 0)
                                <span class="badge rounded-pill bg-warning">{{ $totaltestimonipending }}</span>
                            @endif
                        </span>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>
<div class="container mt-5">
    <h3>Grafik Kunjungan Bulanan</h3>
    <canvas id="monthlyVisitsChart" width="400" height="200"></canvas>
</div>
<script>
    var ctx = document.getElementById('monthlyVisitsChart').getContext('2d');
    var monthlyVisitsChart = new Chart(ctx, {
        type: 'bar', // Tipe grafik bisa bar, line, pie, dll.
        data: {
            labels: [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ],
            datasets: [{
                label: 'Total Kunjungan',
                data: @json(array_values($months)),
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
