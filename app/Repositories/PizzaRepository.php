<?php

namespace App\Repositories;

use App\Interfaces\PizzaRepository as PizzaRepositoryInterface;
use App\Models\Pizza;

class PizzaRepository implements PizzaRepositoryInterface
{
    public function findAll()
    {
        return Pizza::all();
    }

    public function findById($id)
    {
        return Pizza::query()->find($id);
    }

    public function create(array $data)
    {
        return Pizza::create($data);
    }

    public function update(array $data, $id)
    {
        $pizza = $this->findById($id);

        $pizza->update($data);

        return $pizza;
    }

    public function delete($id)
    {
        $pizza = $this->findById($id);

        $pizza->ingredients()->detach();

        return $pizza->delete();
    }
}
