@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        .content {
            background-color: {{ $background_color }};
            min-height: 100vh;
        }
    </style>

    <div class="content py-6">
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-5">
                    <h1 class="text-3xl mb-4">Photos de la page d'accueil</h1>
                    <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
                        @csrf
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="photo" name="photo">
                            <label class="custom-file-label" for="photo">Choisir une image</label>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Valider</button>
                    </form>

                    <div class="portfolio" data-aos="fade-right" data-aos-offset="150">
                        <div class="container-fluid tm-container-content">
                            <div class="row tm-gallery pt-5">
                                @foreach($photos as $photo)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5" data-aos="fade-up" data-aos-offset="250">
                                        <figure class="effect-ming tm-video-item">
                                            <img src="{{ asset('storage/app/public/' . $photo->path) }}" alt="Image" class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">
                                            <figcaption class="d-flex align-items-center justify-content-center">
                                                <a href="photo-detail.html" class="btn btn-light"><i class="fas fa-eye"></i> View more</a>
                                            </figcaption>
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

@endsection
