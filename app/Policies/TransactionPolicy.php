<?php

namespace App\Policies;

use App\Resources\Transaction;
use App\Resources\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Transaction $transaction)
    {
        return $this->userOwnsTransaction($user, $transaction);
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Transaction $transaction)
    {
        return $this->userOwnsTransaction($user, $transaction);
    }

    public function delete(User $user, Transaction $transaction)
    {
        return $this->userOwnsTransaction($user, $transaction);
    }

    private function userOwnsTransaction(User $user, Transaction $transaction): bool
    {
        return $user->id === $transaction->user_id;
    }
}
