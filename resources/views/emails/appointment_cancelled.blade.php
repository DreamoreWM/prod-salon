<!DOCTYPE html>
<html>
<head>
    <title>Rendez-vous annulé</title>
</head>
<body>
<h1>Rendez-vous annulé</h1>
<p>Bonjour {{ $employee->name }},</p>
<p>Nous vous informons que le rendez-vous suivant a été annulé :</p>
<ul>
    <li><strong>Client :</strong> {{ $user->name }}</li>
    <li><strong>Date :</strong> {{ \Carbon\Carbon::parse($appointment->start_time)->format('d/m/Y') }}</li>
    <li><strong>Heure :</strong> {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}</li>
</ul>
<p>Merci,</p>
<p>L'équipe de {{ config('app.name') }}</p>
</body>
</html>
