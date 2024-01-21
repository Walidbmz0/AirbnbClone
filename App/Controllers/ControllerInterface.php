<?php

namespace App\Controllers;

interface ControllerInterface
{
    public static function redirect(
        string $uri,
        int $status = 302,
        array $header = []
    );
}