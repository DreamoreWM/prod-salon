@php
    // Supposons que vous avez une table 'settings' avec une colonne 'background_color'
    use App\Models\SalonSetting;
    $backgroundColor = SalonSetting::first()->background_color;
    $salonName = SalonSetting::first()->name;
    $address = SalonSetting::first()->address;

    $startTime = \Carbon\Carbon::parse($appointment->start_time)->translatedFormat('d F Y \de H:i');
    $endTime = \Carbon\Carbon::parse($appointment->end_time)->translatedFormat('H:i');

@endphp

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification de Réservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: {{ $backgroundColor }};
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            color: #fff;
        }
        .content {
            padding: 20px;
        }
        .content h3 {
            color: {{ $backgroundColor }};
        }
        .content ul {
            list-style-type: none;
            padding: 0;
        }
        .content ul li {
            background-color: #e9ecef;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>{{ $salonName }}</h1>
    </div>
    <div class="content">
        <p>Bonjour {{ $user->name }},</p>

        <p>Un nouveau créneau a été réservé sur votre agenda :</p>

        <h3>Détails de la Réservation</h3>
        <ul>
            <li><strong>Date et Heure :</strong> {{ $startTime }} à {{ $endTime }}</li>
            <li><strong>Client :</strong> {{ $user->name }}</li>
            <li><strong>Email du client :</strong> {{ $user->email }}</li>
        </ul>

        <h3>Prestations Réservées :</h3>
        <ul>
            @foreach ($prestations as $prestation)
                <li>{{ $prestation->nom }} ({{ $prestation->temps }} minutes)</li>
            @endforeach
        </ul>

        <p>Veuillez vérifier votre agenda pour plus de détails.</p>
        <p>Merci,</p>
        <p>{{ $salonName }}</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ $salonName }}. Tous droits réservés.</p>
        <p>{{ $address }}</p>
    </div>
</div>
</body>
</html>
