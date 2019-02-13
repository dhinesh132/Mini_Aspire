<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'duration' => 'required|int',
            'loan_amount' => 'required|numeric',
            'repayment_frequency' => 'required|int',
            'interest_rate' => 'required|numeric',
            'arrangement_fee' => 'required|numeric'
        ];
    }
}
