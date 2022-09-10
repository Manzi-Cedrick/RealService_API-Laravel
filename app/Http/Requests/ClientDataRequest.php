<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientDataRequest extends FormRequest
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
            'Firstname'=>'required|max:100',
            'Lastname'=>'required|max:100',
            'Cash_Paid_Frw'=>'required|min:0',
            'Status_Payment'=>'required',
            'Quantity_Paid_For'=>'required|min:0',
            'Description_Work'=>'required',
        ];
    }
}
