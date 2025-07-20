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
    private const DECAY_SECONDS = 86400;

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('POST')) {
            // if already rate limited, just abort
            if (! RateLimiter::remaining('bot:' . $request->ip(), self::ATTEMPTS) > 0) {
                abort(429);
            }

            // hidden form field not typically filled in by humans
            if ($request->filled('name')) {
                RateLimiter::attempt('bot:' . $request->ip(), self::ATTEMPTS, fn () => true, self::DECAY_SECONDS);

                Log::warning(sprintf('Bot submitted /%s: %s', $request->route()->uri, $request->ip()));
                Sleep::for(0.5)->seconds();

                abort(429);
            }
        }

        return $next($request);
    }
}
