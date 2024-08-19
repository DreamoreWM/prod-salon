<div>
    <style>

        .disabled-slot {
            text-decoration: line-through;
            color: #ccc;
            pointer-events: none;
            background-color: #f0f0f0;
        }


        .div-responsive {
            display: none;
        }

        .laptop {
            display: block;
        }

        /* Affiche le div pour les écrans d'au moins 600px de large */
        @media (max-width: 900px) {
            .div-responsive {
                display: block;
            }
            .laptop {
                display: none;
            }
        }

        .collapse {
            visibility: visible;
        }

        swiper-container::part(button-prev){
            left: 20px;
            top: 50px;
            max-height: 20px;
        }

        swiper-container::part(button-next){
            right: 20px;
            top: 50px;
            max-height: 20px;
        }

        .col {
            min-width: 100px;
        }

        .swiper-slide {
            margin-left: auto; /* Centre le contenu si les marges sont égales des deux côtés */
            margin-right: auto; /* Centre le contenu si les marges sont égales des deux côtés */
            max-width: 95%; /* Ou une autre valeur pour contrôler la largeur */
        }

        .content {
            position: relative;
            background-color: {{ $backgroundColor }};
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            height: calc(100vh - 80px); /* Ajuster la hauteur pour laisser de l'espace pour la navbar */
            padding-top: 10px; /* Ajouter un padding pour décaler le contenu */
            overflow-y: auto;
        }

        .badge {
            cursor: pointer;
        }




    </style>
    <div class="content pt-10">
        <div class="pt-10 content-inner">
            <!-- Affichage des prestations -->
            <div class="pt-10 m-3 mx-auto max-w-screen-lg px-4 lg:px-12" style="font-size: 30px">
                <div class="inline-block">
                    @if(count($selectedPrestations) === 0)
                        <h1><span style="color: dodgerblue">1.</span> Choix de la prestation</h1>
                    @else
                        <h1><span style="color: dodgerblue">1.</span> Prestation sélectionnée</h1>
                    @endif
                </div>
            </div>

            <section class="mt-2">
                <div class="mx-auto max-w-screen-lg px-4 lg:px-12">
                    <div class="mb-4 d-flex justify-content-center bg-white rounded-lg shadow">
                        <div class="col">
                            @if(count($selectedPrestations) === 0 || $showAddPrestationDiv)
                                @foreach ($categories as $categorie)
                                    <div class="accordion" id="accordionPrestations{{ $categorie->id }}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $categorie->id }}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $categorie->id }}" aria-expanded="false" aria-controls="collapse{{ $categorie->id }}">
                                                    {{ $categorie->name }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $categorie->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $categorie->id }}" data-bs-parent="#accordionPrestations{{ $categorie->id }}">
                                                <div class="accordion-body">
                                                    @foreach ($categorie->prestations as $prestation)
                                                        @if (!in_array($prestation->id, $selectedPrestations))
                                                            <div class="card m-3">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-6">
                                                                            <h5 class="card-title">{{ $prestation->nom }}</h5>
                                                                        </div>
                                                                        <div class="col-12 col-md-3 d-flex align-items-center" style="color: gray">
                                                                            <p class="mb-0">{{ $prestation->temps }} min</p>
                                                                            <p class="mx-2 mb-0"> • </p>
                                                                            <p class="mb-0 font-weight-bold">{{ $prestation->prix }} €</p>
                                                                        </div>
                                                                        <div class="col-12 col-md-3 d-flex align-items-center justify-content-end mt-2 mt-md-0">
                                                                            <button wire:click="togglePrestation({{ $prestation->id }})" class="btn btn-primary">Sélectionner</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            @if(count($selectedPrestations) !== 0 || $showAddPrestationDiv)

                                    @if(count($selectedPrestations) !== 0)
                                        <div class="mb-4 d-flex justify-content-center">
                                            <div class="col">
                                                @foreach ($this->getSelectedPrestations() as $index => $prestation)
                                                    <div class="card-body d-flex justify-content-between border-none ml-10 mr-20 mt-8 mb-2">
                                                        <div class="font-bold">
                                                            <p>{{ $prestation['categorie'] }}</p>
                                                            <p>{{ $prestation['name'] }}</p>
                                                            <p class="text-gray-400">{{ $prestation['temps'] }} min<span class="ml-2 mr-2"> • </span> {{ $prestation['prix'] }} €</p>
                                                        </div>
                                                        <div>
                                                            <button wire:click="deletePrestation({{ $index }})" class="text-red-500">Supprimer</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                <div class="card-body justify-content-between border-none ml-10 mr-20 mb-2">
                                    <div class="mb-2">
                                        <h1>Avec qui?</h1>
                                    </div>
                                    <div class="row d-flex justify-center m-3">
                                        @foreach ($employees as $employee)
                                            <div class="col-auto">
                                                <div class="card">
                                                    <div class="card-body d-flex align-items-center">
                                                        <label class="form-check-label rounded-circle text-center" for="employee-{{ $employee->id }}" style="width: 35px; height: 35px; line-height: 35px; background: #000; color: #fff;">
                                                            {{ strtoupper(substr($employee->name, 0, 1)) }}
                                                        </label>
                                                        <h5 class="card-title ml-2 mr-20 ">{{ $employee->name }}</h5>
                                                        <div class="form-check form-check-inline" style="margin-right: -10px;">
                                                            <input class="form-check-input" type="radio" wire:model.live="selectedEmployee" value="{{ $employee->id }}" id="employee-{{ $employee->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if(count($selectedPrestations) !== 0)
                                    <button wire:click="toggleAddPrestationDiv" class="btn btn-secondary">Ajouter une prestation</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            @if(count($selectedPrestations) !== 0 && $selectedEmployee)
                <div class="laptop">
                    <div class="mx-auto max-w-screen-lg px-4 lg:px-12" style="font-size: 30px">
                        <div class="inline-block">
                            <h1><span style="color: dodgerblue">2.</span> Créneaux disponibles</h1>
                        </div>
                    </div>
                    <section class="mt-2">
                        <div class="mx-auto max-w-screen-lg px-4 lg:px-12">
                            <swiper-container class="mySwiper" navigation="true">
                                @php
                                    $currentWeekStart = \Carbon\Carbon::now()->startOfWeek();
                                    $oneMonthLater = $currentWeekStart->copy()->addMonth();
                                    $now = \Carbon\Carbon::now(); // Date et heure actuelles
                                @endphp
                                @while($currentWeekStart->lt($oneMonthLater))
                                    @php
                                        $currentWeekEnd = $currentWeekStart->copy()->addDays(6);
                                    @endphp
                                    <swiper-slide>
                                        <div class="week-container mb-4 d-flex justify-content-center bg-white rounded-lg shadow" style="min-height: 50vh; overflow-x: auto;">
                                            <div class="row flex-nowrap">
                                                @while($currentWeekStart->lte($currentWeekEnd))
                                                    @php
                                                        $formattedDay = $currentWeekStart->format('Y-m-d');
                                                        $daySlots = collect($availableSlots)->filter(function($slot) use ($formattedDay) {
                                                            return $slot['date'] == $formattedDay;
                                                        });
                                                    @endphp
                                                    <div class="col" style="min-width:120px; text-align: center; padding: 3px" wire:key="week-day-{{ $formattedDay }}">
                                                        <div class="day mb-3 mt-3 align-items-center justify-content-center">
                                                            <h5>{{ $currentWeekStart->format('l') }}</h5>
                                                            <h5 style="color: gray; font-weight: bold">{{ $currentWeekStart->format('d M') }}</h5>
                                                        </div>
                                                        @foreach($daySlots as $slot)
                                                            @php
                                                                $slotDateTime = \Carbon\Carbon::parse($slot['date'] . ' ' . $slot['start']);
                                                                $isPast = $slotDateTime->lt($now); // Vérifier si le créneau est dans le passé
                                                            @endphp
                                                            <div>
                                                <span wire:click="{{ !$isPast ? "showConfirmationModal('{$slot['date']}', '{$slot['start']}')" : '' }}" class="badge bg-gray-200 mb-2 {{ $isPast ? 'disabled-slot' : '' }}" style="font-weight: normal; color: black; font-size:14px; padding: 13px 40px; border-radius: 10px;">
                                                    {{ $slot['start'] }}
                                                </span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @php $currentWeekStart->addDay(); @endphp
                                                @endwhile
                                            </div>
                                        </div>
                                    </swiper-slide>
                                    @php
                                        $currentWeekStart = $currentWeekEnd->copy()->addDay();
                                    @endphp
                                @endwhile
                            </swiper-container>
                        </div>
                    </section>
                </div>

            @endif

            @if(count($selectedPrestations) !== 0 && $selectedEmployee)
                <div class="div-responsive">
                    <div class="mx-auto max-w-screen-lg px-4 lg:px-12" style="font-size: 30px">
                        <div class="inline-block">
                            <h1><span style="color: dodgerblue">2.</span> Choix de la date</h1>
                        </div>
                    </div>
                    <section class="mt-2">
                        <div class="mx-auto max-w-screen-lg px-4 lg:px-12">
                            @php
                                $startOfMonth = \Carbon\Carbon::now()->startOfWeek();
                                $endOfMonth = $startOfMonth->copy()->addMonth();
                                $currentWeekStart = $startOfMonth->copy();
                                $oneMonthLater = $currentWeekStart->copy()->addMonth();
                            @endphp
                            @while($currentWeekStart->lt($oneMonthLater))
                                @php
                                    $currentWeekEnd = $currentWeekStart->copy()->addDays(6);
                                @endphp
                                <div class="week-container mb-4 d-flex align-items-center justify-center justify-content-center bg-white rounded-lg shadow" style="min-height: 50vh; overflow-x: auto;">
                                    <div class="col flex-nowrap">
                                        @php $weekDayIndex = 0; @endphp
                                        @while($currentWeekStart->lte($currentWeekEnd))
                                            @php
                                                $formattedDay = $currentWeekStart->format('Y-m-d');
                                                $accordionId = 'dateAccordion' . $weekDayIndex;
                                                $headingId = 'flush-heading' . $weekDayIndex;
                                                $collapseId = 'flush-collapse' . $weekDayIndex;
                                                $hasValidSlots = collect($availableSlots)->firstWhere('date', $formattedDay) !== null;
                                            @endphp
                                            <div class="accordion accordion-flush" id="{{ $accordionId }}">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="{{ $headingId }}">
                                                        <button class="accordion-button {{ $hasValidSlots ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="{{ $hasValidSlots ? 'true' : 'false' }}" style="background-color: transparent !important">
                                                            <div class="day align-items-center justify-content-center">
                                                                <h5>{{ $currentWeekStart->format('l') }}</h5>
                                                                <h5 style="color: gray; font-weight: bold">{{ $currentWeekStart->format('d M') }}</h5>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $hasValidSlots ? 'show' : '' }}" aria-labelledby="{{ $headingId }}" data-bs-parent="#{{ $accordionId }}">
                                                        <div class="flex-wrap d-flex accordion-body">
                                                            @foreach($availableSlots as $slot)
                                                                @if($slot['date'] == $formattedDay)
                                                                    <div>
                                                                <span wire:click="showConfirmationModal('{{ $slot['date'] }}', '{{ $slot['start'] }}')" class="badge bg-gray-200 mb-2" style="font-weight: normal; color: black; font-size:14px; padding: 13px 40px; border-radius: 10px;">
                                                                    {{ $slot['start'] }}
                                                                </span>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $currentWeekStart->addDay();
                                                $weekDayIndex++;
                                            @endphp
                                        @endwhile
                                    </div>
                                </div>
                        @php
                            $currentWeekStart = $currentWeekEnd->copy()->addDay();
                        @endphp
                        @endwhile
                    </section>
                </div>
            @endif
        </div>

        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation de réservation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Prestations sélectionnées :</h6>
                        <ul>
                            @foreach ($selectedPrestationsDetails as $prestation)
                                <li>{{ $prestation['name'] }} ({{ $prestation['temps'] }} min) - {{ $prestation['prix'] }} €</li>
                            @endforeach
                        </ul>
                        <h6>Date et heure :</h6>
                        <p>{{ $selectedSlotDetails ? $selectedSlotDetails['date'] . ' à ' . $selectedSlotDetails['start'] : '' }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="closeModal">Annuler</button>
                        <button type="button" class="btn btn-primary" wire:click="confirmFinalReservation">Confirmer</button>
                    </div>
                </div>
            </div>
        </div>

        <form id="reservation-form" method="POST" action="{{ route('confirmReservation') }}">
            @csrf
            <input type="hidden" name="date" id="date">
            <input type="hidden" name="start" id="start">
            <input type="hidden" name="end" id="end">
            <input type="hidden" name="prestations" id="prestations">
            <input type="hidden" name="employee_id" id="employee_id">
            <input type="hidden" name="email" id="email"> <!-- Ajout du champ email -->
        </form>


        @script
        <script>
            Livewire.on('show-swal-confirmation', event => {
                const { prestations, slot, employeeId } = event.detail || {};
                if (!prestations || !slot) {
                    console.error('Détails manquants dans l\'événement', event.detail);
                    return;
                }

                // Convertir la date au format souhaité
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                const formattedDate = new Date(slot.date).toLocaleDateString('fr-FR', options);

                let prestationList = prestations.map(p => `<li style="list-style-type: disc;">${p.name} (${p.temps} min) - ${p.prix} €</li>`).join('');

                // Construire le HTML de la boîte de dialogue
                let swalHtml = `
            <h6>Prestations sélectionnées :</h6>
            <ul>${prestationList}</ul>
            <br>
            <h6>Date et heure :</h6>
            <p>Le ${formattedDate} de ${slot.start} à ${slot.end}</p>
            <br>
        `;

                // Ajouter le champ e-mail si l'utilisateur n'est pas connecté
                if (!isUserLoggedIn) {
                    swalHtml += `
                <h6>Entrez votre adresse e-mail :</h6>
                <input type="email" id="emailInput" class="swal2-input" placeholder="Votre email" required>
            `;
                }

                Swal.fire({
                    title: 'Confirmation de réservation',
                    html: swalHtml,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmer',
                    cancelButtonText: 'Annuler',
                    preConfirm: () => {
                        if (!isUserLoggedIn) {
                            const email = document.getElementById('emailInput').value;
                            if (!email || !validateEmail(email)) {
                                Swal.showValidationMessage('Veuillez entrer une adresse e-mail valide');
                                return false;
                            }
                            return email;
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Récupérer le formulaire
                        const form = document.getElementById('reservation-form');

                        // Mettre à jour les champs cachés
                        document.getElementById('date').value = slot.date;
                        document.getElementById('start').value = slot.start;
                        document.getElementById('end').value = slot.end;
                        document.getElementById('prestations').value = JSON.stringify(prestations);
                        document.getElementById('employee_id').value = employeeId;

                        if (!isUserLoggedIn) {
                            document.getElementById('email').value = result.value; // Assign the captured email
                        }

                        // Soumettre le formulaire
                        form.submit();
                    }
                });

                // Function to validate email format
                function validateEmail(email) {
                    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()[\]\\.,;:\s@"]+\.)+[^<>()[\]\\.,;:\s@"]{2,})$/i;
                    return re.test(String(email).toLowerCase());
                }
            });
        </script>








        @endscript



    </div>



