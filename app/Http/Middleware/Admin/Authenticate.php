<?php

namespace App\Http\Middleware\Admin;

use Closure;
use App\Models\Auth\AuthAdmin;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (! AuthAdmin::isAuthed()) {
			AuthAdmin::release();
            return redirect(route('admin.login'));
        }

		return $next($request);
    }
}
