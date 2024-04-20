<?php

namespace App\Services;

use App\Repositories\IngredientRepository;
use App\Repositories\PizzaRepository;

class PizzaService
{
    public function __construct(
        protected PizzaRepository $pizzaRepository,
        protected IngredientRepository $ingredientRepository
    )
    {
    }

    public function findAll()
    {
        return $this->pizzaRepository->findAll();
    }

    public function findById($id)
    {
        $pizza = $this->pizzaRepository->findById($id);

        $pizza->ingredients = $pizza->ingredients()->get();

        return $pizza;
    }

    public function create(array $data)
    {
        $pizza = $this->pizzaRepository->create($data);

        $pizza->ingredients()->attach($data['ingredients']);

        return $pizza;
    }

    public function update(array $data, $id)
    {
        $pizza = $this->pizzaRepository->update($data, $id);

        $pizza->ingredients()->sync($data['ingredients']);

        return $pizza;

    }

    public function delete($id)
    {
        return $this->pizzaRepository->delete($id);
    }

}
