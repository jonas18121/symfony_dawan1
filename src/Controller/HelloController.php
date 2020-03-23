<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function hello()
    {
        $response = new Response();
        $response->setContent('bonjour tous le monde !' . "\n" );
        $response->headers->set('content-Type', 'text/plain');
        $response->setStatusCode(Response::HTTP_PARTIAL_CONTENT);

        return $response;
    }
}
