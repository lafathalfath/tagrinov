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
<div class="col-md-6">
    <canvas id="kunjunganChart"></canvas>
</div>
<!-- Script untuk Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('kunjunganChart').getContext('2d');
    var kunjunganChart = new Chart(ctx, {
        type: 'bar', // Bisa diganti dengan 'line' jika ingin chart line
        data: {
            labels: @json(array_values($bulanArray)), // Label bulan hingga bulan saat ini
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: @json(array_values($kunjunganPerBulan->toArray())), // Data jumlah kunjungan per bulan
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
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

@endsection
