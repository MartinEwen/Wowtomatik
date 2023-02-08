<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RouteNotFoundException extends NotFoundHttpException
{
    public function __construct(string $message = 'Route not found', \Exception $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
