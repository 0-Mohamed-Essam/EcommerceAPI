<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @para \Closure $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    if (Auth::user() && Auth::user()->is_admin = 1) {
      return $next($request);
    }

    return response([
      'error' => true,
      'message' => "You don't have a permission to access this page"
    ]);
  }
}
