@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="mb-1">Dashboard</h1>
        <div class="text-muted">Pregled ključnih informacija o sistemu</div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-4">
        <div class="card border-0 h-100">
            <div class="card-body">
                <div class="text-muted small">Ukupno kupaca</div>
                <div class="fs-3 fw-bold">{{ $kupciUkupno }}</div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card border-0 h-100">
            <div class="card-body">
                <div class="text-muted small">Ukupno nekretnina</div>
                <div class="fs-3 fw-bold">{{ $nekretnineUkupno }}</div>
                <div class="small text-muted mt-2">
                    Slobodno: <b>{{ $nekretnineSlobodno }}</b> •
                    Rezervisano: <b>{{ $nekretnineRezervisano }}</b> •
                    Prodato: <b>{{ $nekretnineProdato }}</b>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card border-0 h-100">
            <div class="card-body">
                <div class="text-muted small">Prihod (završene prodaje)</div>
                <div class="fs-3 fw-bold">{{ number_format($prihodUkupno, 0, ',', '.') }} €</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-6">
        <div class="card border-0 h-100">
            <div class="card-body">
                <h5 class="mb-3">Status nekretnina</h5>
                <canvas id="nekretninaChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card border-0 h-100">
            <div class="card-body">
                <h5 class="mb-3">Prodajni levak - vrednost po statusu</h5>
                <div style="position: relative; height: 300px;">
                    <canvas id="funnelChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div></div>

<div class="row g-3 mt-0">
    <div class="col-12 col-lg-6">
        <div class="card border-0 h-100">
            <div class="card-body">
                <h5 class="mb-3">Broj prodaja po statusu</h5>
                <div style="position: relative; height: 300px;">
                    <canvas id="prodajaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Poslednje prodaje</h5>
                    <a href="{{ route('prodaja.index') }}" class="btn btn-sm btn-outline-secondary">Sve prodaje</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Kupac</th>
                                <th>Nekretnina</th>
                                <th>Agent</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($poslednjeProdaje as $p)
                            <tr>
                                <td>{{ $p->kupac?->prezime }} {{ $p->kupac?->ime }}</td>
                                <td>{{ $p->nekretnina?->oznaka }}</td>
                                <td>{{ $p->agent?->prezime }} {{ $p->agent?->ime }}</td>
                                <td>{{ $p->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Nema podataka.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Funnel Data:', {
        nacrt: {{ $funnelNacrt }},
        rezervisana: {{ $funnelRezervisana }},
        zavrsena: {{ $funnelZavrsena }},
        otkazana: {{ $funnelOtkazana ?? 0 }}
    });

    // Nekretnina Chart
    const nekretninaCtx = document.getElementById('nekretninaChart').getContext('2d');
    new Chart(nekretninaCtx, {
        type: 'doughnut',
        data: {
            labels: ['Slobodno', 'Rezervisano', 'Prodato'],
            datasets: [{
                data: [{{ $nekretnineSlobodno }}, {{ $nekretnineRezervisano }}, {{ $nekretnineProdato }}],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                borderColor: ['#fff', '#fff', '#fff'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 15 }
                }
            }
        }
    });

    // Prodaja Chart
    const prodajaCtx = document.getElementById('prodajaChart').getContext('2d');
    new Chart(prodajaCtx, {
        type: 'bar',
        data: {
            labels: ['Nacrt', 'Rezervisana', 'Završena', 'Otkazana'],
            datasets: [{
                label: 'Broj prodaja',
                data: [{{ $prodajeNacrt }}, {{ $prodajeRezervisano }}, {{ $prodajeZavrseno }}, {{ $prodajeOtkazana ?? 0 }}],
                backgroundColor: ['#007bff', '#ffc107', '#28a745', '#dc3545'],
                borderColor: ['#0056b3', '#e0a800', '#1e7e34', '#bd2130'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: true,
                    labels: { padding: 15 }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

    // Sales Funnel Chart
    const funnelCtx = document.getElementById('funnelChart').getContext('2d');
    console.log('Creating funnel chart with values:', [{{ $funnelNacrt }}, {{ $funnelRezervisana }}, {{ $funnelZavrsena }}, {{ $funnelOtkazana ?? 0 }}]);
    
    new Chart(funnelCtx, {
        type: 'bar',
        data: {
            labels: ['Nacrt', 'Rezervisana', 'Završena', 'Otkazana'],
            datasets: [{
                label: 'Vrednost prodaje (EUR)',
                data: [{{ $funnelNacrt }}, {{ $funnelRezervisana }}, {{ $funnelZavrsena }}, {{ $funnelOtkazana ?? 0 }}],
                backgroundColor: [
                    'rgba(23, 162, 184, 0.8)',
                    'rgba(255, 193, 7, 0.8)',
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(220, 53, 69, 0.8)'
                ],
                borderColor: [
                    '#17a2b8',
                    '#ffc107',
                    '#28a745',
                    '#dc3545'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    labels: { padding: 15 }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'EUR' }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('en-US', { notation: 'compact' }).format(value);
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection
