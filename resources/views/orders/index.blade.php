@extends('layouts.app')

@section('content')
<div id="commandes" class="section">
    <h2>Liste des Commandes</h2>
    <div id="ordersList">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Produit ID</th>
                    <th scope="col">Produit Nom</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Message</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->product ? $order->product->id : 'Produit non trouvé' }}</td>
                        <td>{{ $order->product ? $order->product->product_name : 'Produit non trouvé' }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->message }}</td>
                        <td>
                            @if ($order->status == 'no')
                                En attente
                            @else
                                Complété
                            @endif
                        </td>
                        <td>
                            @if ($order->status == 'no')
                                <form action="{{ route('orders.complete', ['id' => $order->id]) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check"></i> Marquer comme Complété
                                    </button>
                                </form>
                            @else
                                <button type="button" class="btn btn-success" disabled>
                                    <i class="fas fa-check"></i> Complété
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
