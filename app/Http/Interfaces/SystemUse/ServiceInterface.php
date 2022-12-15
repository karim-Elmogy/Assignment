<?php

namespace App\Http\Interfaces\SystemUse;

interface ServiceInterface
{
    public function index();

    public function update($request);

    public function delete($id);
}
