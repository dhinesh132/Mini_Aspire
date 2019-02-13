<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'id' => $this->id,
        'user' => $this->user,
        'duration' => $this->duration,
        'loan_amount' => $this->loan_amount,
        'arrangement_fee' => $this->arrangement_fee,
        'repayment_frequency' => $this->repayment_frequency,
        'interest_rate' => $this->interest_rate,
        'amount_paid' => $this->amount_paid,
        'balance_amount' => $this->balance_amount,
        'next_payment_date' => $this->next_payment_date,
        'total_to_be_paid' => $this->total_to_be_paid,
        'repayments' => $this->payments,
        'status' => $this->status,
        'created_at' => (string) $this->created_at,
        'updated_at' => (string) $this->updated_at
      ];
    }
}
