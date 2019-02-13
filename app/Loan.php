<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'duration', 'loan_amount', 'arrangement_fee', 'repayment_frequency',
        'interest_rate', 'amount_paid', 'balance_amount', 'next_payment_date', 'status','total_to_be_paid'
    ];
    
    /** 
     * Payments associated with Loan 
     * 
     **/
    public function payments()
    {
        return $this->hasMany('App\Payment','loan_id');
    }
    
    /** 
     * User Belongs To this Loan 
     * 
     **/
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
