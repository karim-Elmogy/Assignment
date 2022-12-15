<?php

namespace App\Http\Interfaces\Api;

interface OrderInterface
{
    public function index();

    public function store($request);

    public function cancel($id);

}
