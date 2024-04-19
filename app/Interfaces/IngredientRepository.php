<?php

namespace App\Interfaces;

interface IngredientRepository
{
    public function findAll();
    public function findById($id);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
