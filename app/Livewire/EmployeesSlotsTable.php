<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\SalonSetting;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesSlotsTable extends Component
{
    use WithPagination;


    public $search = '';
    public $perPage = 5;

    public function render()
    {
        $backgroundColor = SalonSetting::first()->background_color;
        return view('livewire.employees-slots-table',
        [
            'backgroundColor' => $backgroundColor,
            'employees' => Employee::search($this->search)->paginate($this->perPage)
        ]);
    }

    public function delete(Employee $employee)
    {
        $employee->delete();
    }


}
