


{{-- Vue Blade pour prendre un rendez-vous --}}
@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800  leading-tight">
        {{ __('Avis') }}
    </h2>
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        @import url(https://fonts.googleapis.com/css?family=Ek+Mukta:200);

        body {
            font-family: "Ek Mukta", sans-serif;

        }

        .content {
            background-color:  {{ $background_color }};
            min-height: 100vh;
        }

        .sorting-options {
            margin-bottom: 20px;
        }
        .review-card {
            border: 1px solid #ECECEC;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
            box-shadow: 0 19px 38px rgba(0,0,0,0.10), 0 15px 12px rgba(0,0,0,0.02);
        }
        .testimonial-name {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .date-rating {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .rating-group {
            display: inline-flex;
        }
        .rating__icon {
            pointer-events: none;
        }
        .rating__label {
            cursor: pointer;
            padding-left: 0;
            font-size: 1rem;
        }
        .rating__icon--star {
            color: orange;
        }
        .rating__icon--star-o {
            color: #ddd;
        }
        .date-create {
            font-size: 0.9rem;
            color: #555;
        }
        .image-slider {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .review-image {
            width: 50px;
            height: 50px;
            border-radius: 4px;
            object-fit: cover;
            cursor: pointer;
        }
        #image-modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.9);
        }
        #image-modal-content {
            margin: 15% auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }
    </style>


    <div class="content  ">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

            <div class=" dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

                <div class="container">
                    <h1>Liste des Avis</h1>

                    <div class="sorting-options">
                        <label for="sort">Trier par :</label>
                        <select id="sort" onchange="sortReviews()">
                            <option value="date" {{ request()->query('sort') == 'date' ? 'selected' : '' }}>Date</option>
                            <option value="rating" {{ request()->query('sort') == 'rating' ? 'selected' : '' }}>Évaluation</option>
                        </select>
                    </div>

                    <div id="reviews-list">
                        @foreach ($reviews as $review)
                            <div class="review-card bg-white">
                                <h1 class="testimonial-name">{{ $review->appointment->bookable->name }}</h1>
                                <div class="date-rating">
                                    <div class="rating-group">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <label aria-label="{{ $i }} star" class="rating__label"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            @else
                                                <label aria-label="{{ $i }} star" class="rating__label"><i class="rating__icon rating__icon--star-o fa fa-star-o"></i></label>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="date-create">
                                        {{ $review->created_at->translatedFormat('d M Y') }}
                                    </div>
                                </div>
                                <p style="margin-top: 5px">{{ $review->comment }}</p>
                                <div class="image-slider" style="padding-bottom: 5px">
                                    @if(optional($review->photo))
                                        @foreach($review->photo as $photo)
                                            <div class="photo">
                                                <img src="{{ asset('storage/' . $photo->filename) }}" alt="Photo de la revue" class="review-image" onclick="showImage(this)">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div/>



                <div id="image-modal" onclick="this.style.display='none'">
                    <span class="close">&times;</span>
                    <img id="image-modal-content">
                </div>
            </div>
    </div>

@endsection

@section('scripts')

    <script>
        function showImage(img) {
            var modal = document.getElementById('image-modal');
            var modalImg = document.getElementById('image-modal-content');
            modal.style.display = "block";
            modalImg.src = img.src;
        }

        function sortReviews() {
            var sort = document.getElementById('sort').value;
            window.location.href = '?sort=' + sort;
        }
    </script>


@endsection

