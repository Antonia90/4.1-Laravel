<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecipePolicy
{
    use HandlesAuthorization;

    /**
     * Antes de cualquier otra verificación: si es admin, permitir todo.
     * Esto evita repetir checks de admin en cada método.
     */
    public function before(?User $user, $ability)
    {
        if ($user && $user->hasRole('admin')) {
            return true;
        }
    }

    // Cualquiera (incluso guest) puede listar recetas
    public function viewAny(?User $user): bool
    {
        return true;
    }

    // Cualquiera puede ver una receta
    public function view(?User $user, Recipe $recipe): bool
    {
        return true;
    }

    // Crear: cualquier usuario autenticado con rol 'user' o 'admin' (admin ya pasa por before)
    public function create(User $user): bool
    {
       return $user->hasRole('user') || $user->hasRole('admin');
    }

    // Actualizar: solo el dueño (user_id === user->id). Admin ya pasó por before.
    public function update(User $user, Recipe $recipe): bool
    {
        return $user->id === $recipe->user_id;
    }

    // Borrar: solo el dueño. Admin ya pasó por before.
    public function delete(User $user, Recipe $recipe): bool
    {
        return $user->id === $recipe->user_id;
    }
}
