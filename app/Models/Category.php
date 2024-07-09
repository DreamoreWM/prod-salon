<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Explored;
use Laravel\Scout\Searchable;

class Category extends Model implements Explored
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
    ];

    public function prestations()
    {
        return $this->hasMany(Prestation::class);
    }

    public function mappableAs(): array
    {
        return [
            'name' => 'text',
        ];
    }
}
