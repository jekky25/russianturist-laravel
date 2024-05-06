<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Config;


class DontEndSlash
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
		//do it for phpUnit tests
		$requesUri = $request->getRequestUri();
		$requesUri = $requesUri != $_SERVER['REQUEST_URI'] && !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $requesUri;

		//check url for the presence of a trailing slash
		if (!preg_match('/.+\/$/', $requesUri))
		{
		$base_url = Config::get('app.url');
		return Redirect::to($base_url.$request->getRequestUri().'/');
		}
		return $next($request);
	}
}

