<?php

namespace App\Http\Middleware;

use Closure;
use App\Permission;
use Illuminate\Contracts\Auth\Guard;
use App\Exceptions\PermissionDenied;


class CheckPermission
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $permission_name = $request->route()->getName();
        $permission = $this->auth->user()->role->permissions->pluck('name')->toArray();

        if (in_array($permission_name, $permission) ) {

                return $next($request);

        } else {

            throw new PermissionDenied();

        }
    }   
}
