@extends('layouts.app')

@section('content')
    <div class="content pt-10">
        <div class="container pt-10">
            <!-- Titre conditionnel -->
            @if(auth()->user()->hasRole('admin'))
                <h1>Carte de Fidélité de {{ $user->name }}</h1>
            @else
                <h1>Ma Carte de Fidélité</h1>
            @endif

            @if($loyaltyCards->isEmpty())
                <div class="alert alert-info">
                    @if(auth()->user()->hasRole('admin'))
                        Aucune carte de fidélité n'a été trouvée pour cet utilisateur.
                    @else
                        Vous n'avez pas encore de carte de fidélité.
                    @endif
                </div>
                @if(auth()->user()->hasRole('admin'))
                    <button class="btn btn-primary create-card mt-3">Créer une nouvelle carte</button>
                @endif
            @else
                @foreach($loyaltyCards as $card)
                    <div class="card mb-4">
                        <div class="card-header">
                            Carte #{{ $card->card_number }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($card->stamps_array as $stamp)
                                    <div class="col-2">
                                        <div class="stamp {{ $stamp ? 'filled' : '' }}">
                                            {{ $stamp ? '✔️' : '❌' }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Boutons seulement visibles pour les administrateurs -->
                            @if(auth()->user()->hasRole('admin'))
                                <button class="btn btn-success mt-3 add-stamp" data-card-id="{{ $card->id }}">Ajouter un tampon</button>
                                <button class="btn btn-danger mt-3 delete-card" data-card-id="{{ $card->id }}">Supprimer la carte</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <style>
        .stamp {
            font-size: 2rem;
            text-align: center;
            border: 2px solid #ddd;
            padding: 20px;
            margin: 5px;
        }
        .stamp.filled {
            background-color: #4CAF50;
            color: white;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.add-stamp').forEach(button => {
                button.addEventListener('click', function () {
                    const cardId = this.getAttribute('data-card-id');

                    Swal.fire({
                        title: 'Ajouter un tampon?',
                        text: "Cette action ajoutera un tampon à cette carte de fidélité!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Oui, ajouter!',
                        cancelButtonText: 'Non, annuler!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/loyalty-card/${cardId}/add-stamp`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json'
                                }
                            }).then(response => {
                                if (response.ok) {
                                    Swal.fire('Succès', 'Tampon ajouté avec succès', 'success').then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('Erreur', 'Une erreur est survenue', 'error');
                                }
                            });
                        }
                    });
                });
            });

            document.querySelectorAll('.delete-card').forEach(button => {
                button.addEventListener('click', function () {
                    const cardId = this.getAttribute('data-card-id');

                    Swal.fire({
                        title: 'Supprimer cette carte?',
                        text: "Cette action est irréversible!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Oui, supprimer!',
                        cancelButtonText: 'Non, annuler!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/loyalty-card/${cardId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json'
                                }
                            }).then(response => {
                                if (response.ok) {
                                    Swal.fire('Succès', 'Carte supprimée avec succès', 'success').then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('Erreur', 'Une erreur est survenue', 'error');
                                }
                            });
                        }
                    });
                });
            });

            document.querySelector('.create-card')?.addEventListener('click', function () {
                Swal.fire({
                    title: 'Créer une nouvelle carte?',
                    text: "Cette action créera une nouvelle carte de fidélité pour l'utilisateur.",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, créer!',
                    cancelButtonText: 'Non, annuler!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/loyalty-card/{{ $user->id }}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json'
                            }
                        }).then(response => {
                            if (response.ok) {
                                Swal.fire('Succès', 'Carte créée avec succès', 'success').then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire('Erreur', 'Une erreur est survenue', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
