<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function prestations()
    {
        return $this->hasMany(Prestation::class);
    }
}
