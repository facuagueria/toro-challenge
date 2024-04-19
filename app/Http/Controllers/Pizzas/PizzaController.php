<?php

namespace App\Http\Controllers\Pizzas;

use App\Http\Controllers\Controller;
use App\Services\PizzaService;
use Inertia\Inertia;

class PizzaController extends Controller
{
    public function __construct(protected PizzaService $pizzaService)
    {}

    public function index()
    {
        $pizzas = $this->pizzaService->findAll();

        return Inertia::render('Pizzas/Index', [
            'pizzas' => $pizzas
        ]);
    }
}
