<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ProductName' => 'required|max:100',
            'ProductPrice' => 'required|min:0',
            'ProductQRCode' => 'required|min:0',
            'Quantity' => 'required|min:0',
            'Description' => 'required',
        ];
    }
}
