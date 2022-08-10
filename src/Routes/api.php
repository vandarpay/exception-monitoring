<?php


use Illuminate\Support\Facades\Route;
use VandarPay\ExceptionMonitoring\Actions\ResolverAction;

Route::get('api/exception-monitoring/{key}', ResolverAction::class);
