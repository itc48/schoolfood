<?php

namespace App\Imports;

use App\Models\School;
use App\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class SchoolsImport implements ToModel {
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {
        return new School([
            'uuid' => (string)Str::uuid(),
            'title' => $row[1],
            'address' => $row[2],
            'district_id' => null,
            'longitude' => $row[4],
            'latitude' => $row[3],
        ]);
    }
}
