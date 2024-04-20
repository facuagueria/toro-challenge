<?php

use App\Http\Controllers\Ingredients\IngredientController;
use App\Http\Controllers\Pizzas\PizzaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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

require __DIR__ . '/auth.php';
