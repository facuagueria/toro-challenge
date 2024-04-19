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
