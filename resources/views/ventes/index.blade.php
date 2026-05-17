@extends('layouts.app')

@section('title', 'Rapport des ventes')

@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Rapport des ventes</h5>
        <div class="card-body">
            <form method="GET" action="{{ route('ventes.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="date_debut" class="form-label">Date de début</label>
                    <input type="date" class="form-control" id="date_debut" name="date_debut"
                        value="{{ old('date_debut', $data['date_debut'] ?? '') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <input type="date" class="form-control" id="date_fin" name="date_fin"
                        value="{{ old('date_fin', $data['date_fin'] ?? '') }}" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">Ventes du {{ $data['date_debut'] ?? '?' }} au {{ $data['date_fin'] ?? '?' }}</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Livre</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($ventes as $vente)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($vente->date)->format('d/m/Y') }}</td>
                            <td>{{ $vente->livre->titre }}</td>
                            <td>{{ $vente->quantite }}</td>
                            <td>{{ number_format($vente->livre->prix, 2, ',', ' ') }} $</td>
                            <td>{{ number_format($vente->livre->prix * $vente->quantite, 2, ',', ' ') }} $</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucune vente trouvée pour cette période.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total général</th>
                        <th>{{ number_format($totalVentes, 2, ',', ' ') }} $</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


    {{-- Graphique des ventes (AJOUTÉ en-dessous du tableau) --}}
    <div class="card my-4">
        <h5 class="card-header">Graphique des ventes</h5>
        <div class="card-body">
            <canvas id="salesChart" width="400" height="200"></canvas>
        </div>
    </div>

    {{-- Chargement de Chart.js depuis CDN et initialisation du graphique --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const labels = @json(array_keys($salesByDate));
        const data = @json(array_values($salesByDate));

        new Chart(ctx, {
            type: 'bar', // ou 'line' ou 'bar'
            data: {
                labels: labels,
                datasets: [{
                    label: "Chiffre d'affaires ($)",
                    data: data,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection