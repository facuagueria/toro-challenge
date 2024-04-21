<?php

use App\Http\Controllers\Ingredients\IngredientController;
use App\Http\Controllers\Pizzas\PizzaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('pizzas.index');
});

Route::group(['prefix' => 'pizzas'], function () {
    Route::get('/', [PizzaController::class, 'index'])->name('pizzas.index');
    Route::get('/create', [PizzaController::class, 'create'])->name('pizzas.create');
    Route::post('/', [PizzaController::class, 'store'])->name('pizzas.store');
    Route::get('/{pizza}/edit', [PizzaController::class, 'edit'])->name('pizzas.edit');
    Route::put('/{pizza}', [PizzaController::class, 'update'])->name('pizzas.update');
    Route::delete('/{pizza}', [PizzaController::class, 'destroy'])->name('pizzas.destroy');
});

Route::group(['prefix' => 'ingredients'], function () {
    Route::get('/', [IngredientController::class, 'index'])->name('ingredients.index');
    Route::get('/create', [IngredientController::class, 'create'])->name('ingredients.create');
    Route::post('/', [IngredientController::class, 'store'])->name('ingredients.store');
    Route::get('/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredients.edit');
    Route::put('/{ingredient}', [IngredientController::class, 'update'])->name('ingredients.update');
    Route::delete('/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');
});

//require __DIR__ . '/auth.php';
