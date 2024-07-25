<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TemporaryUser extends Model
{

    use hasFactory;

    /**
     * La table associée au modèle.
     *
     * @var string
     */
    protected $table = 'temporary_users';

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    public function appointments()
    {
        return $this->morphMany(Appointment::class, 'bookable');
    }

}
