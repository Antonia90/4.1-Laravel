<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;

Route::get('/', function () {
    return view('welcome');
    //return "Esta es la página de inicio :)";
});
Route::resource('recipes', RecipeController::class);
Route::resource('ingredients', IngredientController::class);
