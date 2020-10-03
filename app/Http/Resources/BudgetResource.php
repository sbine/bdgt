<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BudgetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            $this->mergeWhen(auth()->user()->id === $this->user_id, [
                'date' => $this->date->format('Y-m-d'),
                'category_id' => $this->category->id,
                'category' => $this->category->label,
                'budgeted' => $this->budgeted,
                'spent' => $this->spent,
                'balance' => $this->balance,
                'created_at' => $this->created_at ? $this->created_at->toDateTimeString() : null,
                'updated_at' => $this->updated_at ? $this->updated_at->toDateTimeString() : null,
            ]),
        ];
    }
}
