<?php

namespace App\Http\Controllers\SystemUse;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\SystemUse\ServiceInterface;
use App\Http\Interfaces\SystemUse\UserInterface;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public $ServiceInterface;
    public function __construct(ServiceInterface $ServiceInterface)
    {
        $this->ServiceInterface=$ServiceInterface;
    }

    public function index()
    {
        return $this->ServiceInterface->index();
    }

    public function update(Request $request)
    {
        return $this->ServiceInterface->update($request);
    }

    public function delete($id)
    {
        return $this->ServiceInterface->delete($id);
    }
}
