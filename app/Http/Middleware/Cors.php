<?php

namespace App\Http\Middleware;

use Closure;

class Cors {
	public function handle($request, Closure $next)
	{
		return $next($request)
			->header('Access-Control-Allow-Origin', '*')
			->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
		     ->header('Access-Control-Allow-Headers', 'X-ACCESS_TOKEN,
		     Access-Control-Allow-Origin, Authorization, Origin, x-requested-with,
		     Content-Type, Content-Range, Content-Disposition, Content-Description ');
	}
}