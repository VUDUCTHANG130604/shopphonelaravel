<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.only' => \App\Http\Middleware\AdminOnly::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $csrfExpiredRedirect = function (Request $request) {
            if ($request->is('admin/login') || $request->is('admin/login.php')) {
                return redirect()
                    ->route('admin.login')
                    ->withErrors(['login' => 'Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại.']);
            }

            if ($request->is('admin/*')) {
                return redirect()
                    ->route('admin.login')
                    ->with('error', 'Phiên quản trị đã hết hạn, vui lòng đăng nhập lại.');
            }

            return redirect()
                ->back()
                ->with('error', 'Phiên làm việc đã được làm mới, vui lòng thao tác lại.');
        };

        $exceptions->respond(function (Response $response, \Throwable $exception, Request $request) use ($csrfExpiredRedirect) {
            if ($response->getStatusCode() === 419) {
                return $csrfExpiredRedirect($request);
            }

            return $response;
        });
    })->create();
