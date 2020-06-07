<?php

namespace App\Http\Middleware\Admin;

use Closure;
use App\Models\Auth\AuthAdmin;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (AuthAdmin::isAuthed()) {
            return redirect(route('admin.index'));
        }

		return $next($request);
    }
}
