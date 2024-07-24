<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Config;


class DontEndSlash
{
	private $checkPattern		= '/.+?page=([0-9]+)\/$/';
	private $redirectPattern	= '/.([0-9A-Za-z]*)\?page=([0-9]+)\/$/';
	private $replacementPattern	= '$1/?page=$2';

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
		$requestUri		= $this->getUri($request);
		$trailingSlash	= (Str::contains($requestUri, ['#', '.html', '/?']) ? '' : '/');
		$base_url		= Config::get('app.url');

		if ($this->checkUriForRedirect($requestUri))
		{
			$requestReplaceUri = $this->getNewUri($requestUri);
			return Redirect::to($base_url.$trailingSlash.$requestReplaceUri);
		}

		//check url for the presence of a trailing slash
		if (!empty($trailingSlash) && !preg_match('/.+\/$/', $requestUri))
		{
			return Redirect::to($base_url.$request->getRequestUri().$trailingSlash);
		}
		return $next($request);
	}

	/**
	* get uri by request
	*
	* @param  \Illuminate\Http\Request  $request
	* @return string
	*/
	public function getUri($request)
	{
		$uri = $request->getRequestUri();
		return $uri != $_SERVER['REQUEST_URI'] && !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $uri;
	}

	/**
	* check uri if we get pages like item?page=2/ to redirect the to the valid url
	*
	* @param string $requestUri
	* @return bool
	*/
	public function checkUriForRedirect($requestUri)
	{
		return preg_match($this->checkPattern, $requestUri);
	}

	/**
	* get a new uri for redirect
	*
	* @param  string $requestUri
	* @return string
	*/
	public function getNewUri($requestUri)
	{
		return preg_replace($this->redirectPattern, $this->replacementPattern, $requestUri);
	}
}