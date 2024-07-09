<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Explored;
use Laravel\Scout\Searchable;

class Appointment extends Model implements Explored
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['employee_id', 'start_time', 'end_time', 'bookable_id', 'bookable_type'];

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    // Assurez-vous que la table users existe et que vous avez un modèle User correspondant.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookable()
    {
        return $this->morphTo();
    }

    public function prestations()
    {
        return $this->belongsToMany(Prestation::class, 'appointment_prestation');
    }

    public function mappableAs(): array
    {
        return [
            'start_time' => 'date',
            'end_time' => 'date',
            'created_at' => 'date'
        ];
    }
}
