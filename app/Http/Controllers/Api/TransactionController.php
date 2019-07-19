<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Resources\Transaction;

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
        $transaction->update(request()->all());

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->delete()) {
            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }
}
