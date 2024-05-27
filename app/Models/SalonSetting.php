<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalonSetting extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'open_days', 'slot_duration', 'facebook_page_url', 'image_selector', 'background_color', 'background_image', 'slogan', 'logo'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}
