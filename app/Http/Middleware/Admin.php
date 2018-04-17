<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class Admin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = $request->user();

		if ($user && $user->isadmin == 1)
		{
			return $next($request);
		}
		elseif ($user && $user->isadmin == 2)
		{
			return $next($request);
		}
		 return  Redirect('/');
	}

}