<div>
    @php
        use App\Models\SalonSetting;
        $backgroundColor = SalonSetting::first()->background_color;
    @endphp

    <style>
        .modal-backdrop {
            display: none;
        }

        .content {
            background: {{ $backgroundColor }};
            min-height: 100vh;
        }

        .navbar {
            position: absolute;
        }
    </style>

    <div class="content pt-10">
        <div>
            <section class="mt-10">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <!-- Start coding here -->
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="flex items-center justify-between p-4">
                            <div class="flex">
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input wire:model.live.debounce.300ms="search" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2" placeholder="Search" required>
                                </div>
                            </div>
                            <div class="flex space-x-3">
                                <div class="flex space-x-3 items-center">
                                    <label class="w-40 text-sm font-medium text-gray-900">User Type :</label>
                                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">All</option>
                                        <option value="0">User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table id="employeesTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Name</th>
                                    <th scope="col" class="px-4 py-3">Email</th>
                                    <th scope="col" class="px-4 py-3"><span class="sr-only">Actions</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr wire:key="{{ $user->id }}" class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $user->name }}</th>
                                        <td class="px-4 py-3">{{ $user->email }}</td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button type="button" class="px-3 py-1 bg-blue-500 text-white rounded mr-2" data-toggle="modal" data-target="#userInfoModal{{ $user->id }}">
                                                Info
                                            </button>
                                            <button type="button" class="px-3 py-1 bg-red-500 text-white rounded" onclick="confirmDeletion({{ $user->id }})">X</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="py-4 px-3">
                            <div class="flex">
                                <div class="flex space-x-4 items-center mb-3">
                                    <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                                    <select wire:model.live="perPage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @foreach($users as $user)
            <div class="modal fade" id="userInfoModal{{ $user->id }}" aria-labelledby="userInfoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userInfoModalLabel">User Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Name: {{ $user->name }}</p>
                            <p>Email: {{ $user->email }}</p>
                            <div class="mb-4">
                                <label for="role{{ $user->id }}" class="block text-sm font-medium text-gray-900">Role</label>
                                <select id="role{{ $user->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="user" @if($user->role == 'user') selected @endif>Utilisateur</option>
                                    <option value="admin" @if($user->role == 'admin') selected @endif>Administrateur</option>
                                </select>
                            </div>
                            <h2>RENDEZ VOUS</h2>
                            <div>
                                @foreach($user->getAppointments() as $appointment)
                                    <p>{{ $appointment->formatted_start_time }} - {{ $appointment->formatted_end_time }}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="showRoleConfirmationModal({{ $user->id }})">Save Changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let selectedUserId = null;

        function confirmDeletion(userId) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous allez supprimer cet utilisateur.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Appeler la méthode Livewire pour supprimer l'utilisateur
                @this.call('delete', userId);
                }
            });
        }

        function showRoleConfirmationModal(userId) {
            selectedUserId = userId;
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous allez changer le rôle de cet utilisateur.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, changer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateUserRole(selectedUserId);
                }
            });
        }

        function updateUserRole(userId) {
            var role = document.getElementById('role' + userId).value;

            fetch(`/users/${userId}/update-role`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    role: role
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Role updated successfully') {
                        Swal.fire(
                            'Success!',
                            'Le rôle a été mis à jour avec succès.',
                            'success'
                        );
                        $('#userInfoModal' + userId).modal('hide');
                        location.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            'Échec de la mise à jour du rôle.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'Échec de la mise à jour du rôle.',
                        'error'
                    );
                });
        }
    </script>
