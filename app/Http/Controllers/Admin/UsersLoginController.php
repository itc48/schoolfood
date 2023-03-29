<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReviewsExport;
use App\Http\Controllers\Controller;
use App\Repositories\UsersLoginRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersLoginController extends Controller {

    protected $repository;

    public function __construct() {
        $this->repository = new UsersLoginRepository();
    }

    public function index(Request $request) {
        $users_logins = $this->repository->getAllByLastDay();
        $unique = $this->repository->getUniqueByLastDay($request);

        return view('admin.users_login.index', compact('users_logins', 'unique'));
    }

    public function export(Request $request) {
        $export = new ReviewsExport();
        $export->reviews = $this->repository->getUniqueByLastDay($request)->map(function ($login) {
            return [
                $login->user->school->title ?? '-',
                $login->created_at['date'],
                $login->created_at['time'],
                $login->id,
            ];
        })->toArray();

        array_unshift($export->reviews, [
            'Школа', 'Дата', 'Время', '#'
        ]);

        Excel::store($export, 'logins.xlsx');

        return Excel::download($export, 'logins.xlsx');
    }
}
