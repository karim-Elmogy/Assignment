<?php

namespace App\Http\Interfaces\Api;

interface AuthInterface
{
    public function register($request);

    public function login($request);

    public function Update($request);
}
