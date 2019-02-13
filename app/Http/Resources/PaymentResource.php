<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
        'loan' => new LoanResource($this->loan),
        'amount_paid' => $this->amount_paid,
        'created_at' => (string) $this->created_at,
        'updated_at' => (string) $this->updated_at
      ];
    }
}
