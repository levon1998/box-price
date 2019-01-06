<?php

namespace App\Http\Requests;

use ActionM\WebMoneyMerchant\Test\Dummy\Order;
use App\Rules\CheckBalance;
use App\Rules\CheckPayeerNumber;
use App\Rules\OrderPay;
use Illuminate\Foundation\Http\FormRequest;

class WithDrawFundsSaveRequest extends FormRequest
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
            'payeer_account' => ['required', new CheckPayeerNumber],
            'm_amount' => ['required', 'numeric', 'min:100', new CheckBalance, new OrderPay]
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
            'payeer_account.required' => 'Номер Кошелька обьзательное поля.',
            'm_amount.required' => 'Сумма для вывода обьзательное поля.',
            'm_amount.min' => 'Минимальная сумма для вывода 100 рублей.'
        ];
    }
}
