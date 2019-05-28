<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;

use Auth;
use Closure;
use App\Http\Controllers\User\UsersController;

class CheckModules
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $module_='')
    {
        $uc = new UsersController();
        $request->merge([
            'isSelfOnly' => true,
        ]);
        $usersResponse = $uc->list($request);
        $users = json_decode($usersResponse->content());
        $modules = $users->data[0]->modules;
        $hasAccess = in_array($module_,$modules);

        if ($hasAccess || $request->route()->uri === 'index') {
            return $next($request);
        } else {
            return redirect('/index');
        }
    }
}
