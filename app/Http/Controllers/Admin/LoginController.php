<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Requests\LoginRequest;
//use App\Models\Auth\AuthAdmin;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.login.index');
    }

    public function login(LoginRequest $request)
    {
        // authが完了するとsessionが破棄されるのでここで取り出し
        $returnUrl = AuthAdmin::getReturnUrl();

        AuthAdmin::auth([
            'id'       => $request->id,
            'password' => $request->password
        ]);

        return redirect($returnUrl);
    }
}
