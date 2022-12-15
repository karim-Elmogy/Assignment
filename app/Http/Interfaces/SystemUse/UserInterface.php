<?php

namespace App\Http\Interfaces\SystemUse;

interface UserInterface
{
    public function index();

    public function delete($id);
}
