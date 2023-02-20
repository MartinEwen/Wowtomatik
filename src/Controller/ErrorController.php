<?php
// src/Controller/ErrorController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ErrorController extends AbstractController
{
    public function notFound(): RedirectResponse
    {
        return $this->redirectToRoute('/');
    }

    public function serverError(): RedirectResponse
    {
        return $this->redirectToRoute('/');
    }
}
