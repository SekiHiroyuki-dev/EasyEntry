<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Auth\AuthAdmin;            
                                          
class LogoutController extends Controller
{
	public function index()
	{
		AuthAdmin::release();
		return redirect(route('admin.login'));
	}
}
