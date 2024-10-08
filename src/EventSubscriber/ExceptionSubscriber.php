<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if ($exception instanceof HttpException) {
            $data = [
                'message' => $exception->getMessage(),
                'status' => $exception->getStatusCode(),
            ];
            $event->setResponse(new JsonResponse($data, $exception->getStatusCode()));
        }
        else {
            $data = [
                'message' => $exception->getMessage(),
                'status' => 500,
            ];
            $event->setResponse(new JsonResponse($data, 500));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
