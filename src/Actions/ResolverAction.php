<?php

namespace VandarPay\ExceptionMonitoring\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use VandarPay\ExceptionMonitoring\Facades\ExceptionMonitoring;

class ResolverAction extends Controller
{

    public function __invoke(string $key): JsonResponse
    {
        if (ExceptionMonitoring::exists($key)) {
            return response()->json('NOK', 500);
        }
        return response()->json('OK');
    }
}
