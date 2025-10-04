<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Sleep;
use Laravel\Nightwatch\Http\Middleware\Sample;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class RateLimitBots
{
    private const ATTEMPTS = 1;
    private const DECAY_SECONDS = 43200;
    private const STATUS_CODE = Response::HTTP_TOO_MANY_REQUESTS;

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('POST')) {
            // if already rate limited, just abort
            if (! RateLimiter::remaining('bot:' . $request->ip(), self::ATTEMPTS) > 0) {
                if (LaravelLocalization::getNonLocalizedURL($request->url()) !== $request->url()) {
                    Sample::rate(0.2);
                }
                abort(self::STATUS_CODE);
            }

            // hidden form field not typically filled in by humans
            if ($request->filled('name')) {
                RateLimiter::attempt('bot:' . $request->ip(), self::ATTEMPTS, fn () => true, self::DECAY_SECONDS);

                Log::notice(sprintf('Bot submitted /%s: %s', $request->route()->uri, $request->ip()));
                Sleep::for(0.5)->seconds();

                abort(self::STATUS_CODE);
            }
        }

        return $next($request);
    }
}
