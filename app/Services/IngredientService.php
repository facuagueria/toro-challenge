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

    public function store(array $data)
    {
        $this->ingredientRepository->create($data);
    }

    public function findById($id)
    {
        return $this->ingredientRepository->findById($id);
    }

    public function update(array $data, $id)
    {
        $this->ingredientRepository->update($data, $id);
    }

    public function delete($id)
    {
        $this->ingredientRepository->delete($id);
    }
}
