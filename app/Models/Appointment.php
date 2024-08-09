<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'start_time', 'end_time', 'bookable_id', 'bookable_type'];

    // Assurez-vous que la table users existe et que vous avez un modèle User correspondant.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->prestations->sum('prix');
    }

    public function bookable()
    {
        return $this->morphTo();
    }

    public function prestations()
    {
        return $this->belongsToMany(Prestation::class, 'appointment_prestation');
    }

    public function getFormattedStartTimeAttribute()
    {
        return Carbon::parse($this->start_time)->translatedFormat('l d F Y H:i');
    }

    public function getFormattedEndTimeAttribute()
    {
        return Carbon::parse($this->end_time)->translatedFormat('H:i');
    }

    public function loyaltyCard()
    {
        return $this->belongsTo(LoyaltyCard::class);
    }


}
