<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class SchoolsUsersExport implements FromCollection {

    public $users = [];

    public function collection() {
        return new Collection($this->users);
    }

    public function startCell(): string {
        return 'A2';
    }
}