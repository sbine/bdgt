<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            $this->mergeWhen(auth()->user()->id === $this->user_id, [
                'date' => $this->date->toDateTimeString(),
                'amount' => $this->amount,
                'inflow' => $this->inflow,
                'payee' => $this->payee ?? '',
                'account_id' => $this->account_id,
                'account' => $this->account->only('name'),
                'category_id' => $this->category_id,
                'category' => optional($this->category)->only('label'),
                'bill_id' => $this->bill_id,
                'bill' => optional($this->bill)->only('name'),
                'cleared' => $this->cleared,
                'flair' => $this->flair,
                'created_at' => optional($this->created_at)->toDateTimeString(),
                'updated_at' => optional($this->updated_at)->toDateTimeString(),
            ]),
        ];
    }
}
