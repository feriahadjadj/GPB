<?php

namespace App\Exceptions;

use Exception;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Session\TokenMismatchException;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {



        if ($exception instanceof NotFoundHttpException) {

            return response()->view('layouts.error', ['error' => 'Erreur 404 ,Page introuvable','exception'=>$exception->getMessage()], 404);
        } elseif ($exception instanceof HttpException && $exception->getStatusCode() == 403) {
            return response()->view(
                'layouts.error',
                ['error' => 'Erreur 403, cette page est réservée aux utilisateurs autorisés uniquement.','exception'=>$exception->getMessage()],
                403
            );
        } elseif ($exception instanceof HttpException) {
            Log::info($exception->getMessage());
            return response()->view('layouts.error', ['error' => "Erreur 500,  service indisponible",'exception'=>$exception->getMessage()], 500);
        }elseif($exception instanceof QueryException){
            //dd($exception);
            return  response()->view('layouts.error', ['error' => 'impossible de se connecter au serveur. veuillez ressayer ultérieurement','exception'=>$exception->getMessage()], 500);

        }elseif($exception instanceof TokenMismatchException){
            //dd($exception);
            return  redirect()->route('login')->with('error','La session a expiré :(');

        }
          return parent::render($request, $exception);
    }
}
