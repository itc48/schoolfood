<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller {

    public function main() {
        return view('main');
    }

    public function index() {
        return view('index');
    }

    public function login() {
        return view('login');
    }

}
