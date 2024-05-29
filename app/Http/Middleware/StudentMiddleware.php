<?php

namespace App\Http\Middleware;

use App\Models\Team;
use App\Models\TeamMember;
use Closure;
use Illuminate\Http\Request;
// use Illuminate\View\View;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user=auth()->user();
        $request->attributes->add(['user' => $user]);
        if($user->hasRole('Student'))
        {
            $hasTeam=false;
            $team=NULL;
            if(Team::where('submitted_by',$user->id)->get()->count() || TeamMember::where('user_id',$user->id)->get()->count())
            {
                $hasTeam=true;
                $team=Team::where('submitted_by',$user->id)->first();
                $team=(!empty($team))?$team:TeamMember::where('user_id',$user->id)->first()->team;
            }
            \View::share('team',$team);
            \View::share('hasTeam',$hasTeam);
            $request->attributes->add(['team' => $team]);
        }
        \View::share('user',$user);
        return $next($request);
    }
}
