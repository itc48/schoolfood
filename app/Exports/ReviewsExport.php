<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReviewsExport implements FromCollection {

    public $reviews = [];

    public function collection() {
        return new Collection($this->reviews);
    }

    public function startCell(): string {
        return 'A2';
    }
}
