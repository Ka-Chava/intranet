<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('is_active_route')) {
    function is_active_route(array|string $route, array $parameters = []): bool
    {
        if (is_string($route) && (str_starts_with($route, 'http') || str_starts_with($route, '/'))) {
            $path = ltrim(parse_url($route, PHP_URL_PATH) ?? '', '/');
            return request()->is($path);
        }

        if (is_string($route)) {
            if (Route::currentRouteName() !== $route) {
                return false;
            }

            foreach ($parameters as $key => $value) {
                if (request()->route($key) != $value) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }
}
