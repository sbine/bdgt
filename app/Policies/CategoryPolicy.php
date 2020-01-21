<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Category $category)
    {
        return $this->userOwnsCategory($user, $category);
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Category $category)
    {
        return $this->userOwnsCategory($user, $category);
    }

    public function delete(User $user, Category $category)
    {
        return $this->userOwnsCategory($user, $category);
    }

    private function userOwnsCategory(User $user, Category $category): bool
    {
        return $user->id === $category->user_id;
    }
}
