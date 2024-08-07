<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Employee extends Model
{
    use hasFactory;

    protected $fillable = ['name','surname','email'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'bookable_id')->where('bookable_type', self::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->where('name','like',"%{$value}%")->orWhere('email','like',"%{$value}%");
    }

    public function schedules()
    {
        return $this->hasMany(EmployeeSchedule::class);
    }

}
