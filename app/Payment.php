<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loan_id', 'amount_paid', 'paid_on',
    ];
    
    /** 
     * Loan belongs to this payment 
     * 
     **/
    public function loan()
    {
        return $this->belongsTo('App\Loan','loan_id');
    }
}
