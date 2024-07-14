@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Gestion du salon') }}
    </h2>
@endsection

@section('content')
    <style>
        .content {
            background-color: {{ $background_color }};
            min-height: 100vh;
        }
        .form-label {
            font-size: 1.2em;
            font-weight: bold;
        }
        .image-selector {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .image-selector div {
            border: 2px solid transparent;
            cursor: pointer;
        }
        .image-selector div.selected {
            border-color: #007bff;
        }
    </style>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="content py-6 mt-10 pt-10">
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="container">
                        <h1 class="text-3xl mb-4">Paramètres du Salon</h1>
                        <form method="POST" action="{{ route('salon.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-image"></i> Image pour le Dashboard</label>
                                    <div class="image-selector" id="dashboard-image-selector">
                                        @foreach(File::files(public_path('images/home')) as $file)
                                            @php
                                                $filename = pathinfo($file)['basename'];
                                            @endphp
                                            <div data-filename="{{ $filename }}" class="{{ $filename == $setting->dashboard_image ? 'selected' : '' }}">
                                                <img src="{{ asset('images/home/' . $filename) }}" alt="Image" style="width: 100px; height: 100px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" id="dashboard_image" name="dashboard_image" value="{{ old('dashboard_image', $setting->dashboard_image) }}">
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label"><i class="fas fa-store"></i> Nom du Salon</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $setting->name) }}" placeholder="Nom du Salon">
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label"><i class="fas fa-map-marker-alt"></i> Adresse</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $setting->address) }}" placeholder="Adresse">
                                        <div id="address-list" class="form-control" style="display: none;"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="slot_duration" class="form-label"><i class="fas fa-clock"></i> Durée d'un Créneau (en minutes)</label>
                                        <input type="number" class="form-control" id="slot_duration" name="slot_duration" value="{{ old('slot_duration', $setting->slot_duration) }}" placeholder="Durée d'un Créneau (en minutes)">
                                    </div>

                                    <div class="mb-3">
                                        <label for="facebook_page_url" class="form-label"><i class="fab fa-facebook"></i> Nom page facebook</label>
                                        <input type="text" class="form-control" id="facebook_page_url" name="facebook_page_url" value="{{ old('facebook_page_url', $setting->facebook_page_url) }}" placeholder='(Exemple pour "people/NOM-PAGE-FACEBOOK/100063490666722/" -> "NOM-PAGE-FACEBOOK-100063490666722"'>
                                    </div>

                                    <div class="mb-3">
                                        <label for="slogan" class="form-label"><i class="fas fa-comment-dots"></i> Slogan</label>
                                        <input type="text" class="form-control" id="slogan" name="slogan" value="{{ old('slogan', $setting->slogan) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="background_color" class="form-label"><i class="fas fa-palette"></i> Couleur de fond</label>
                                        <input type="color" class="form-control" id="background_color" name="background_color" value="{{ old('background_color', $setting->background_color) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-image"></i> Image de fond</label>
                                        <button type="button" id="uploadBgButton" class="btn btn-primary">Ajouter une image</button>
                                        <img id="previewbg" style="display: none;">
                                        <input type="file" id="bgUpload" name="bg_upload" style="display: none;">
                                        <div class="image-selector" id="image-selector">
                                            @foreach(File::files(public_path('background')) as $file)
                                                @php
                                                    $filename = pathinfo($file)['basename'];
                                                @endphp
                                                <div data-filename="{{ $filename }}" class="{{ $filename == $setting->background_image ? 'selected' : '' }}">
                                                    <img src="{{ asset('background/' . $filename) }}" alt="Image" style="width: 100px; height: 100px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <input type="hidden" id="background_image" name="background_image" value="{{ old('background_image', $setting->background_image) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-image"></i> Logo</label>
                                        <button type="button" id="uploadLogoButton" class="btn btn-primary">Ajouter un logo</button>
                                        <img id="preview" style="display: none;">
                                        <input type="file" id="logoUpload" name="logo_upload" style="display: none;">
                                        <div class="image-selector" id="image-selector2">
                                            @foreach(File::files(public_path('logo')) as $file)
                                                @php
                                                    $filename = pathinfo($file)['basename'];
                                                @endphp
                                                <div data-filename="{{ $filename }}" class="{{ $filename == $setting->logo ? 'selected' : '' }}">
                                                    <img src="{{ asset('logo/' . $filename) }}" alt="Image" style="width: 100px; height: 100px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <input type="hidden" id="logo" name="logo" value="{{ old('logo', $setting->logo) }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    @php
                                        $openDays = $setting->open_days ? json_decode($setting->open_days, true) : [];
                                    @endphp

                                    @php
                                        \Carbon\Carbon::setLocale('fr');
                                        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                    @endphp

                                    @foreach($days as $day)
                                        <div class="mb-3">
                                            <label class="form-label"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($day)->isoFormat('dddd') }}</label>
                                            <div>
                                                <span style="font-weight: bold; padding-right: 5px">Matin :</span>
                                                <input type="time" name="open_days[{{ $day }}][open]" value="{{ old('open_days.'.$day.'.open', $openDays[$day]['open'] ?? '') }}" placeholder="{{ \Carbon\Carbon::parse($day)->isoFormat('dddd') }} Heure d'Ouverture">
                                                <input type="time" name="open_days[{{ $day }}][break_start]" value="{{ old('open_days.'.$day.'.break_start', $openDays[$day]['break_start'] ?? '') }}" placeholder="{{ \Carbon\Carbon::parse($day)->isoFormat('dddd') }} Début de la Pause">
                                                <span style="font-weight: bold; padding-right: 5px">Aprés-midi :</span>
                                                <input type="time" name="open_days[{{ $day }}][break_end]" value="{{ old('open_days.'.$day.'.break_end', $openDays[$day]['break_end'] ?? '') }}" placeholder="{{ \Carbon\Carbon::parse($day)->isoFormat('dddd') }} Fin de la Pause">
                                                <input type="time" name="open_days[{{ $day }}][close]" value="{{ old('open_days.'.$day.'.close', $openDays[$day]['close'] ?? '') }}" placeholder="{{ \Carbon\Carbon::parse($day)->isoFormat('dddd') }} Heure de Fermeture">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.getElementById('uploadLogoButton').addEventListener('click', function() {
            document.getElementById('logoUpload').click();
        });

        document.getElementById('logoUpload').addEventListener('change', function() {
            var file = this.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                document.getElementById('preview').src = reader.result;
                document.getElementById('preview').style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                document.getElementById('preview').style.display = 'none';
            }
        });

        document.getElementById('uploadBgButton').addEventListener('click', function() {
            document.getElementById('bgUpload').click();
        });

        document.getElementById('bgUpload').addEventListener('change', function() {
            var file = this.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                document.getElementById('previewbg').src = reader.result;
                document.getElementById('previewbg').style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                document.getElementById('previewbg').style.display = 'none';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var imageSelector = document.getElementById('image-selector');
            var backgroundImageInput = document.getElementById('background_image');

            imageSelector.addEventListener('click', function(event) {
                if (event.target.tagName === 'IMG') {
                    var selectedDiv = event.target.parentNode;
                    var filename = selectedDiv.getAttribute('data-filename');
                    backgroundImageInput.value = filename;

                    var previouslySelectedDiv = imageSelector.querySelector('.selected');
                    if (previouslySelectedDiv) {
                        previouslySelectedDiv.classList.remove('selected');
                    }

                    selectedDiv.classList.add('selected');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var imageSelector2 = document.getElementById('image-selector2');
            var logoInput = document.getElementById('logo');

            imageSelector2.addEventListener('click', function(event) {
                if (event.target.tagName === 'IMG') {
                    var selectedDiv = event.target.parentNode;
                    var filename = selectedDiv.getAttribute('data-filename');
                    logoInput.value = filename;

                    var previouslySelectedDiv = imageSelector2.querySelector('.selected');
                    if (previouslySelectedDiv) {
                        previouslySelectedDiv.classList.remove('selected');
                    }

                    selectedDiv.classList.add('selected');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var imageSelector = document.getElementById('dashboard-image-selector');
            var dashboardImageInput = document.getElementById('dashboard_image');

            imageSelector.addEventListener('click', function(event) {
                if (event.target.tagName === 'IMG') {
                    var selectedDiv = event.target.parentNode;
                    var filename = selectedDiv.getAttribute('data-filename');
                    dashboardImageInput.value = filename;

                    var previouslySelectedDiv = imageSelector.querySelector('.selected');
                    if (previouslySelectedDiv) {
                        previouslySelectedDiv.classList.remove('selected');
                    }

                    selectedDiv.classList.add('selected');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var addressInput = document.getElementById('address');
            var addressList = document.getElementById('address-list');

            addressInput.addEventListener('focus', function() {
                addressList.style.display = 'block';
            });

            addressInput.addEventListener('keyup', function() {
                var query = this.value;
                if (query.length > 2) {
                    fetch('https://api-adresse.data.gouv.fr/search/?q=' + query)
                        .then(response => response.json())
                        .then(data => {
                            addressList.innerHTML = '';
                            data.features.forEach(function(feature) {
                                var div = document.createElement('div');
                                div.textContent = feature.properties.label;
                                div.addEventListener('click', function() {
                                    addressInput.value = this.textContent;
                                    addressList.style.display = 'none';
                                });
                                addressList.appendChild(div);
                            });
                        });
                }
            });
        });
    </script>
@endsection
