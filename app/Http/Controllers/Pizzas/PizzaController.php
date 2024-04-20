<?php

namespace App\Http\Controllers\Pizzas;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePizzaRequest;
use App\Http\Requests\UpdatePizzaRequest;
use App\Services\IngredientService;
use App\Services\PizzaService;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PizzaController extends Controller
{
    public function __construct(
        protected PizzaService $pizzaService,
        protected IngredientService $ingredientService
    )
    {
    }

    public function index()
    {
        $pizzas = $this->pizzaService->findAll();

        return Inertia::render('Pizzas/Index', [
            'pizzas' => $pizzas
        ]);
    }

    public function edit($id)
    {
        $pizza = $this->pizzaService->findById($id);
        $ingredients = $this->ingredientService->findAll();

        return Inertia::render('Pizzas/Edit', [
            'pizza' => $pizza,
            'ingredients' => $ingredients
        ]);
    }

    public function create()
    {
        $ingredients = $this->ingredientService->findAll();

        return Inertia::render('Pizzas/Create', [
            'ingredients' => $ingredients
        ]);
    }

    public function store(StorePizzaRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->pizzaService->create($request->validated());

            DB::commit();
            return redirect()->route('pizzas.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception);
        }
    }

    public function update(UpdatePizzaRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->pizzaService->update($request->validated(), $id);

            DB::commit();
            return redirect()->route('pizzas.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception);
        }
    }

    public function destroy($id)
    {
        try {
            $this->pizzaService->delete($id);

            return redirect()->route('pizzas.index');
        } catch (\Exception $exception) {
            return back()->with('error', $exception);
        }
    }
}
