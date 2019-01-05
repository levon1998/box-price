<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplenishFundsSaveRequest extends FormRequest
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
            'm_amount' => 'required|numeric|min:50'
        ];
    }

    /**
     * Get the validation rules and make send messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'm_amount.min' => 'Минимальная сумма для пополнения 50 рублей.'
        ];
    }
}
