<?php

namespace App\Http\Middleware;

use App\Thread;
use Session;
use Closure;

class ViewThreadMiddleware
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
        $viewedThreads = collect($request->session()->get('thread.views'));
        $thread = $request->route()->getParameter('thread');
        if(!$viewedThreads->contains($thread->id)){
            $thread->increment('views');
            $request->session()->push('thread.views', $thread->id);
        }
        return $next($request);
    }
}
