<?php

namespace App\Services;

use App\Repositories\IngredientRepository;

class IngredientService
{
    public function __construct(protected IngredientRepository $ingredientRepository)
    {
    }

    public function findAll()
    {
        return $this->ingredientRepository->findAll();
    }
}
