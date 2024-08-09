<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyCard extends Model
{
    use HasFactory;

    // Ajoutez les colonnes que vous souhaitez pouvoir remplir en masse ici
    protected $fillable = ['user_id', 'stamps', 'card_number'];

    protected $appends = ['stamps_array'];

    public function getStampsArrayAttribute()
    {
        $stamps = [];

        for ($i = 0; $i < 6; $i++) {
            $stamps[] = $i < $this->stamps;
        }

        return $stamps;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
