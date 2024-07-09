<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Explored;
use Laravel\Scout\Searchable;

class Prestation extends Model implements Explored
{
    use hasFactory;
    use Searchable;


    // Protéger les champs assignables en masse
    protected $fillable = [
        'nom', 'description', 'prix', 'temps','category_id'
    ];

    /**
     * Relation avec le modèle Slot (si vous avez un modèle Slot pour les créneaux horaires).
     * Cela suppose que vous avez un modèle Slot qui a une clé étrangère 'prestation_id'.
     */
    public function slots()
    {
        return $this->hasMany(Slot::class);
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_prestation');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function mappableAs(): array
    {
        return [
            'nom' => 'text'
        ];
    }
}
