<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Explored;
use Laravel\Scout\Searchable;

class Absence extends Model implements Explored
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['employee_id', 'start_time', 'end_time'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


    public function mappableAs(): array
    {
        return [
            'start_time' => 'date',
            'end_time' => 'date',
            'created_at' => 'date'
        ];
    }
}
