<?php

namespace App\Http\Controllers\Auth;

use App\Builders\UsersLoginBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function __invoke(Request $request) {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $usersLoginBuilder = new UsersLoginBuilder();
            $usersLoginBuilder
                ->createEmpty()
                ->setUserId(Auth::user()->id)
                ->save();

            switch (Auth::user()->role->code) {
                case 'ADMIN':
                    return redirect('/admin/schools/');
                    break;
                case 'MODERATOR':
                    return redirect('/moderator/schools/');
                    break;
                case 'SCHOOLCHILDREN':
                    return redirect('/schoolchildren/schools/');
                    break;
                default:
                    return redirect('/login');
                    break;
            }
        }

        return redirect('/login');
    }

    public function username()
    {
        return 'name';
    }

}
