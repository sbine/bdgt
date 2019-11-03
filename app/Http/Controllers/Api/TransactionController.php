<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Transaction::class);
    }

    public function store()
    {
        Transaction::create(request()->all());

        return response()->json([
            'success' => true,
        ]);
    }

    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    public function update(Transaction $transaction)
    {
        if ($transaction->update(request()->all())) {
            session()->flash('alerts.success', trans('crud.transactions.updated'));

            return response()->json([
                'success' => true,
            ]);
        }

        session()->flash('alerts.danger', trans('crud.transactions.error'));

        return response()->json([
            'success' => false,
        ]);
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->delete()) {
            session()->flash('alerts.success', trans('crud.transactions.deleted'));

            return response()->json([
                'success' => true,
            ]);
        }

        session()->flash('alerts.danger', trans('crud.transactions.error'));

        return response()->json([
            'success' => false,
        ]);
    }
}
