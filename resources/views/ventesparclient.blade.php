@extends('layouts.app')

@section('title', 'Ventes par client')

@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Filtrer les ventes par client</h5>
        <div class="card-body">
            <form method="GET" action="{{ route('ventesparclient.index') }}" class="row g-3">
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

    @forelse ($ventesParClient as $info)
        <div class="card mb-4">
            <h5 class="card-header">
                Client :
                {{ $info['client']->prenom ?? '' }} {{ $info['client']->nom ?? 'Client inconnu' }}
            </h5>
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
                        @foreach ($info['ventes'] as $vente)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($vente->date)->format('d/m/Y') }}</td>
                                <td>{{ $vente->livre->titre }}</td>
                                <td>{{ $vente->quantite }}</td>
                                <td>{{ number_format($vente->livre->prix, 2, ',', ' ') }} $</td>
                                <td>{{ number_format($vente->livre->prix * $vente->quantite, 2, ',', ' ') }} $</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total client</strong></td>
                            <td><strong>{{ number_format($info['total'], 2, ',', ' ') }} $</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Aucune vente trouvée pour cette période.
        </div>
    @endforelse

    <div class="card">
        <div class="card-body text-end">
            <h5>Total général des ventes : <strong>{{ number_format($totalVentes, 2, ',', ' ') }} $</strong></h5>
        </div>
    </div>
@endsection