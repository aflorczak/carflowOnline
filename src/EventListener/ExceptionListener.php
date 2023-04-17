<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $request   = $event->getRequest();

        if ('application/json' === $request->headers->get('Content-Type'))
        {
            $response = new JsonResponse([
                "message" => $exception->getMessage()
            ]);

            $event->setResponse($response);
        }
    }
}