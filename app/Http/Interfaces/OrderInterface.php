<?php

namespace App\Http\Interfaces;

interface OrderInterface
{
  public function index();

  public function store($request ,$id);

  public function update($request);

  public function destroy($request);

  public function cancel($id);
}
