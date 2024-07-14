<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SalonSetting extends Model
{
    use hasFactory;

    protected $fillable = [
        'name', 'address', 'open_days', 'slot_duration', 'facebook_page_url',
        'image_selector', 'background_color', 'background_image', 'slogan', 'logo',
        'dashboard_image'
    ];
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}
