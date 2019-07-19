<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TransactionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            $this->mergeWhen(auth()->user()->id === $this->user_id, [
                'date' => $this->date,
                'amount' => $this->amount * ($this->inflow ? 1 : -1),
                'payee' => $this->payee ?? '',
                'account' => $this->account->name ?? '',
                'category' => $this->category->name ?? '',
                'bill' => $this->bill->name ?? '',
                'cleared' => $this->cleared,
                'flair' => $this->flair,
                'created_at' => $this->created_at->toDateTimeString(),
                'updated_at' => $this->updated_at->toDateTimeString(),
            ])
        ];
    }
}
