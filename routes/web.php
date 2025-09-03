<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;

Route::get('/', function () {
    return view('layouts/app');
});

Route::resource('recipes', RecipeController::class);
Route::resource('ingredients', IngredientController::class);

