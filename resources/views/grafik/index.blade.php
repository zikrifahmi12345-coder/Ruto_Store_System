@extends('layouts.admin')

@section('title', 'Grafik Penjualan')

@section('content')
<div class="ruto-stat-card ruto-fade-in mb-6" style="max-width:320px;">
    <p class="ruto-stat-label">Penjualan Bulan Ini</p>
    <p class="ruto-stat-value highlight">Rp {{ number_format($penjualanBulanIni, 0, ',', '.') }}</p>
</div>

<div class="ruto-grid-2">
    <div class="ruto-card ruto-card-padded ruto-fade-in-delay-1">
        <h3 class="ruto-card-title">Penjualan 7 Hari Terakhir</h3>
        <canvas id="chartHarian" height="200"></canvas>
    </div>
    <div class="ruto-card ruto-card-padded ruto-fade-in-delay-2">
        <h3 class="ruto-card-title">Penjualan per Kategori (Bulan Ini)</h3>
        <canvas id="chartKategori" height="200"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const rutoBrand = '#e6a227';
    const rutoBrandDark = '#c4881a';
    const rutoPalette = ['#e6a227', '#c4881a', '#f5d998', '#5c3d2e', '#8b7355', '#d4a84b'];

    new Chart(document.getElementById('chartHarian'), {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Penjualan (Rp)',
                data: @json($data),
                borderColor: rutoBrand,
                backgroundColor: 'rgba(230, 162, 39, 0.15)',
                fill: true,
                tension: 0.35,
                pointBackgroundColor: rutoBrandDark,
            }]
        },
        options: {
            responsive: true,
            animation: { duration: 800, easing: 'easeOutQuart' },
            scales: { y: { beginAtZero: true } }
        }
    });

    new Chart(document.getElementById('chartKategori'), {
        type: 'doughnut',
        data: {
            labels: @json($penjualanPerKategori->pluck('nama_kategori')),
            datasets: [{
                data: @json($penjualanPerKategori->pluck('total')),
                backgroundColor: rutoPalette,
                borderWidth: 2,
                borderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            animation: { animateRotate: true, duration: 900 },
        }
    });
</script>
@endpush
