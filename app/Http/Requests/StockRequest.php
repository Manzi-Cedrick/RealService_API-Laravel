<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
            //
            'Stock_Name'=>'required|min:4',
            'Stock_Quantity'=>'required|min:0',
            'Registration_Date'=>'required',
            'Expiration_Date'=>'required'
        ];
    }
}
