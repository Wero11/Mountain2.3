<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;


class UserAuthenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
				
		$obj = app('session');
		if(isset($obj->get('user_detail')[0]->id) && ($obj->get('user_detail')[0]->id!=""))
		{
			$appsession=1;
		}
		else
		{
			$appsession=0;
		}
		
		if ($this->auth->guest() && ($appsession==0))
		{
			
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				
				return redirect()->guest('login');
			}
		}
		
		return $next($request);
	}

}
