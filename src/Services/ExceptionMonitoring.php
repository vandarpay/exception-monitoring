<?php

namespace VandarPay\ExceptionMonitoring\Services;

use Illuminate\Support\Facades\Redis;

class ExceptionMonitoring
{

    public static function set(string $key, ?int $ttl = null): void
    {
        Redis::set("exception-monitoring:$key", true, "EX", $ttl !== null ? $ttl : config('exception-monitoring.ttl'));
    }

    public static function exists(string $key): bool
    {
        return (bool)Redis::exists("exception-monitoring:$key");
    }

    public static function remove(string $key): bool
    {
        return (bool)Redis::del("exception-monitoring:$key");
    }
}
