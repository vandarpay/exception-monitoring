<?php

namespace VandarPay\ExceptionMonitoring\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void set(string $key, null|int $ttl = null)
 * @method static bool exists(string $key)
 * @method static bool remove(string $key)
 *
 * @see  \VandarPay\ExceptionMonitoring\Services\ExceptionMonitoring
 *
 */
class ExceptionMonitoring extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'exceptionMonitoring';
    }

}
