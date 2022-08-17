<?php

namespace VandarPay\ExceptionMonitoring\Actions;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use VandarPay\ExceptionMonitoring\Facades\ExceptionMonitoring;

class ResolverAction extends Controller
{

	public function __invoke(Request $request, string $key): JsonResponse
	{
		$token = $request->header('X-TOKEN');

		if (!$token || $token !== config('exception-monitoring.token')) {
			response()->json('UNAUTHENTICATED', 401);
		}

		if (ExceptionMonitoring::exists($key)) {
			return response()->json('NOK', 500);
		}

		return response()->json('OK');
	}
}
