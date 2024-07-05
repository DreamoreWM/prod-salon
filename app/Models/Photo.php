<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Photo extends Model
{
    use hasFactory;

    protected $fillable = ['review_id', 'filename'];

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
