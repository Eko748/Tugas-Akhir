<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // return response()->view('pages.error.404.index', ['role_id' => $role_id], Response::HTTP_NOT_FOUND);
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            if ($exception instanceof HttpException && $exception->getStatusCode() == 404) {
                $user = Auth::user();
                $role_id = $user ? $user->role_id : null;
                return response()->view('pages.error.404.index', ['role_id' => $role_id])->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0',
                ]);
            }
        }
        // $user = Auth::user();
        // $role_id = $user ? $user->role_id : null;
        // return response()->view('pages.error.404.index', ['role_id' => $role_id])->withHeaders([
        //     'Cache-Control' => 'no-cache, no-store, must-revalidate',
        //     'Pragma' => 'no-cache',
        //     'Expires' => '0',
        // ]);
        // return view('pages.error.404.index');
        // return parent::render($request, $exception);
    }
}
