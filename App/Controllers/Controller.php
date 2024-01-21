<?php

namespace App\Controllers;

use App\App;
use Laminas\Diactoros\Response\RedirectResponse;

abstract class Controller implements ControllerInterface
{
    public static function redirect(
        string $uri,
        int $status = 302,
        array $header = [])
    {
        $response = new RedirectResponse($uri, $status, $header);
        App::getApp()->getRouter()->getPublisher()->publish($response);
        die();
    }
}