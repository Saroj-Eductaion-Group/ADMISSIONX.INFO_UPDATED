<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;
use Session;
use App;
use Request;
use Illuminate\Contracts\Auth\Guard;

class AdminEmpAuthenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new middleware instance.
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
        if( Auth::check() ){
            //VALIDATE WITHT THE ADMIN ROLE
            $validateWithApplicantRole = DB::table('users')
                                        ->where('users.id', '=', AUTH::id())
                                        ->where('users.userstatus_id', '=', '1')
                                        ->whereIN('users.userrole_id', [1,4])
                                        ->count()
                                        ;                
            if( $validateWithApplicantRole == '1'){
                /*if( env('APP_DEBUG') == 0 ){
                    if(!$request->secure()) {
                       return redirect()->secure($request->path());
                    }    
                }else{
                  if ($this->auth->guest()) {
                        return $next($request);
                    }  
                }*/
                return $next($request);
            }else{
                Auth::logout();
                Session::flash('returnBackSignup', 'Access Denied.');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/login');    
            }
        }else{
            Auth::logout();
            Session::flash('returnBackSignup', 'Access Denied.');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/login');
        }
        // return $next($request);
    }
}
