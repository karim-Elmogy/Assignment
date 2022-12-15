<?php

namespace App\Http\Controllers\SystemUse;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\SystemUse\UserInterface;

class UserController extends Controller
{
    public $UserInterface;
    public function __construct(UserInterface $UserInterface)
    {
        $this->UserInterface=$UserInterface;
    }

    public function index()
    {
        return $this->UserInterface->index();
    }
    public function delete($id)
    {
        return $this->UserInterface->delete($id);
    }
}
