<?php

namespace App\Http\Middleware;

use App\Models\Bimbingan;
use App\Models\Outline;
use App\Models\Proposal;
use App\Models\Skripsi;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIdAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role, $bagian): Response
    {
        return $next($request);
    }
}
