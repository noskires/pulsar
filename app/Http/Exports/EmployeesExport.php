<?php

namespace App\Http\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView; 
use App\Employee;
use App\User;

class EmployeesExport implements FromView
{
    public function view(): View
    {
        return view('export.exportEmployees', [
            'users' => User::all()
        ]);
    }
}