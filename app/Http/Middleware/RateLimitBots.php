<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Sleep;
use Symfony\Component\HttpFoundation\Response;

class RateLimitBots
{
    private const ATTEMPTS = 1;
    private const DECAY_SECONDS = 43200;

    public function handle(Request $request, Closure $next): Response
    {
        // hidden form field not typically filled in by humans
        if ($request->isMethod('POST') && $request->filled('name')) {
            if (! RateLimiter::attempt('bot:' . $request->ip(), self::ATTEMPTS, fn () => true, self::DECAY_SECONDS)) {
                abort(429);
            }

            Log::warning(sprintf('Bot submitted /%s: %s', $request->route()->uri, $request->ip()));
            Sleep::for(0.5)->seconds();

            return back()->with('status', 'Success!');
        }

        return $next($request);
    }
}
