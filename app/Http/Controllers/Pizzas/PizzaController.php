<?php

namespace App\Http\Controllers\Pizzas;

use App\Http\Controllers\Controller;
use App\Services\IngredientService;
use App\Services\PizzaService;
use Inertia\Inertia;

class PizzaController extends Controller
{
    public function __construct(protected PizzaService $pizzaService, protected IngredientService $ingredientService)
    {
    }

    public function index()
    {
        $pizzas = $this->pizzaService->findAll();

        return Inertia::render('Pizzas/Index', [
            'pizzas' => $pizzas
        ]);
    }

    public function create()
    {
        $ingredients = $this->ingredientService->findAll();

        return Inertia::render('Pizzas/Create', [
            'ingredients' => $ingredients
        ]);
    }
}
