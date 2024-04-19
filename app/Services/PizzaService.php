<?php

namespace App\Services;

use App\Repositories\PizzaRepository;

class PizzaService
{
    public function __construct(protected PizzaRepository $pizzaRepository)
    {
    }

    public function findAll()
    {
        return $this->pizzaRepository->findAll();
    }

}
