<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardExpirationDate;
use LVR\CreditCard\CardNumber;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nbr-carte" => [
                "required",
                new CardNumber(),
            ],
            "date" => [
                "required",
                new CardExpirationDate("m/y"),
            ],
            "ccv" => [
                "required",
                new CardCvc($this->get('nbr-carte')),
            ],
        ];
    }
}
