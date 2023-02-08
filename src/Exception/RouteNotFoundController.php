<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RouteNotFoundController
{
    public function __invoke(NotFoundHttpException $exception)
    {
        return new RedirectResponse('/');
    }
}
