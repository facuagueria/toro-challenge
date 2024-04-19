<?php

namespace App\Repositories;

use App\Interfaces\IngredientRepository as IngredientRepositoryInterface;
use App\Models\Ingredient;

class IngredientRepository implements IngredientRepositoryInterface
{
    public function findAll()
    {
        return Ingredient::all();
    }

    public function findById($id)
    {
        // TODO: Implement findById() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
