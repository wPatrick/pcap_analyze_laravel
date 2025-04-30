<?php

namespace App\Http\Middleware;

use App\Events\BuildMenuEvent;
use App\Providers\RouteServiceProvider;
use App\Services\Menu\Menu;
use App\Services\Menu\Renderers\ArrayRenderer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Symfony\Component\HttpFoundation\Response;

class HandleWizardRequests extends Middleware
{
    public function handle($request, Closure $next)
    {
        if(request()->has('wizard')) {
            session()->put('wizard', $request->get('wizard'));
        }
        return parent::handle($request, $next);
    }
}
