<?php

namespace Ross\SlimApi\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class InvoiceController
{

    public function index(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write("Invoice controller");
        return $response;
    }
}