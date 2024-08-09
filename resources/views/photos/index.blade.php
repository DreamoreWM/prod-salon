@extends('layouts.app')

@section('content')


    <style>
        .content {
            background-color: {{ $background_color }};
            min-height: 100vh;
        }
    </style>

    <div class="content py-6 pt-10">
        <section class="mt-10 pt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-5">
                    <h1 class="text-3xl mb-4">Photos de la page d'accueil</h1>
                    <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
                        @csrf
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="photo" name="photo" onchange="previewImage(event)">
                        </div>
                        <img id="imagePreview" src="" alt="Image Preview" style="display:none; width: 200px; height: auto; margin-top: 10px;"/>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Valider</button>
                    </form>

                    <div class="portfolio" data-aos="fade-right" data-aos-offset="150">
                        <div class="container-fluid tm-container-content">
                            <div class="row tm-gallery pt-5">
                                @foreach($photos as $photo)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5" data-aos="fade-up" data-aos-offset="250">
                                        <figure class="effect-ming tm-video-item">
                                            <img src="{{ asset('storage/app/public/' . $photo->path) }}" alt="Image" class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">

                                            <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> Supprimer
                                                </button>
                                            </form>
                                        </figure>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Empêche le formulaire de se soumettre immédiatement
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas annuler cette action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); // Soumet le formulaire si l'utilisateur confirme
                }
            });
        }
    </script>


@endsection
