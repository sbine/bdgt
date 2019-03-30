<?php

namespace App\Http\Requests;

class StoreTransactionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date'        => 'required|date',
            'amount'      => 'required',
            'payee'       => 'required',
            'account_id'  => 'required|numeric',
            'inflow'      => 'required',
            'category_id' => 'numeric',
        ];
    }
}
