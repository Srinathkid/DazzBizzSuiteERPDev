<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated.',
                'data' => null,
            ], 401);
        }

       if (!$user->hasPermission($permission)) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to perform the action.',
                'data' => null,
            ], 403);
        }

        return $next($request);

     /*return response()->json([
            'success' => true,
            'message' => 'Authenticated inside permission middleware.',
            'data' => [
                'user_id' => $user->id,
                'username' => $user->username,
                'permission_requested' => $permission,
            ],
        ]);*/

      /* return response()->json([
        'success' => true,
        'message' => 'CheckPermission reached.',
        'data' => [
            'user' => $user?->username,
            'permission' => $permission,
        ],
    ]);  */

    }
}
