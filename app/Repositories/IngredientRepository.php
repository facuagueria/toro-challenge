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
        return Ingredient::findOrFail($id);
    }

    public function create(array $data)
    {
        Ingredient::create($data);
    }

    public function update(array $data, $id)
    {
        $ingredient = $this->findById($id);
        $ingredient->update($data);
    }

    public function delete($id)
    {
        $ingredient = $this->findById($id);
        $ingredient->delete();
    }
}
