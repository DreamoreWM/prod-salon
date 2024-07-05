<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Explored;
use JeroenG\Explorer\Application\IndexSettings;
use Laravel\Scout\Searchable;

class Employee extends Model implements Explored, IndexSettings
{
    use hasFactory;
    use Searchable;

    protected $fillable = ['name','surname','email'];

    public function mappableAs(): array
    {
        return [
            'name' => 'text',
            'email' => 'keyword',
            'created_at' => 'date'
        ];
    }

    public function indexSettings(): array
    {
        return [
            'analysis' => [
                'analyzer' => [
                    'standard_lowercase' => [
                        'type' => 'custom',
                        'tokenizer' => 'standard',
                        'filter' => ['lowercase'],
                    ],
                ],
            ],
        ];
    }

    public function slots()
    {
        return $this->hasMany(Slot::class);
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
