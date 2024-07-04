<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Photospres extends Model
{
    use hasFactory;
    use Searchable;

    protected $fillable = ['path'];
}
