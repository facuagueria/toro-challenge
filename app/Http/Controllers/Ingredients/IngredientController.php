<?php

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Services\IngredientService;
use Inertia\Inertia;

class IngredientController extends Controller
{
    public function __construct(protected IngredientService $ingredientService)
    {
    }

    public function index()
    {
        $ingredients = $this->ingredientService->findAll();

        return Inertia::render('Ingredients/Index', [
            'ingredients' => $ingredients
        ]);
    }

    public function create()
    {
        return Inertia::render('Ingredients/Create');
    }

    public function store(StoreIngredientRequest $request)
    {
        try {
            $this->ingredientService->store($request->all());

            return redirect()->route('ingredients.index');
        } catch (\Exception $exception) {
            return back()->with('error', $exception);
        }
    }

    public function edit($id)
    {
        $ingredient = $this->ingredientService->findById($id);

        return Inertia::render('Ingredients/Edit', [
            'ingredient' => $ingredient
        ]);
    }

    public function update(UpdateIngredientRequest $request, $id)
    {
        try {
            $this->ingredientService->update($request->all(), $id);

            return redirect()->route('ingredients.index');
        } catch (\Exception $exception) {
            return back()->with('error', $exception);
        }
    }

    public function destroy($id)
    {
        try {
            $this->ingredientService->delete($id);

            return redirect()->route('ingredients.index');
        } catch (\Exception $exception) {
            return back()->with('error', $exception);
        }
    }
}
