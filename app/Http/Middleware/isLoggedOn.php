<?php
namespace App\Http\Middleware;
use Closure;
class isLoggedOn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->get('email') === null) {
            return response()->json(['message' => 'Unauthorized request.'], 401);
        }
        return $next($request);
    }
}