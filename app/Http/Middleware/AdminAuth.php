<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\UserRole;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth('sanctum')->user();
        $user_role = UserRole::where('user_id', $user->id)->first();
        $role = Role::where('id', $user_role->role_id)->first();
        if ($role->name !== 'Adminstrator') {
            return response()->json([
                'message' => 'Access Denied',
                'status' => 'Error'
            ],403);
        }

        return $next($request);

    }
}
