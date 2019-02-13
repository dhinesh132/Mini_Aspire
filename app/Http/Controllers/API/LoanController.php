<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\LoanRequest;
use App\Http\Requests\PaymentRequest;
use App\Loan;
use App\Payment;
use Carbon\Carbon;
use App\Http\Resources\LoanResource;
use App\Http\Resources\PaymentResource;
use App\Http\Controllers\Controller;

class LoanController extends Controller
{
   
    /**
     * Construct
     * @return  
     */
    public function __construct()
    {
        $this->successStatus = 200;
        $this->unauthorizedStatus = 401;
        $this->errorStatus = 400;
    }
    
    /** 
     * Loan Create api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function create(LoanRequest $request) 
    { 
        $input = $request->all();  
        
        $term = $input['duration'];
        $i = $input['interest_rate'];
        $amt = $input['loan_amount'];

        $int = $i/1200;
        $int1 = 1+$int;
        $r1 = pow($int1, $term);

        $pmt = ($amt*($int*$r1)/($r1-1)) * $term;

        $total_amt_to_pay = round(($pmt + $input['arrangement_fee']),2);

        $input['total_to_be_paid'] = $total_amt_to_pay;

        $input['balance_amount'] = $total_amt_to_pay;

        $loan = Loan::create($input); 
        return response()->json(['success'=>new LoanResource($loan)], $this-> successStatus); 
    }
    
    /** 
     * Loan Repayment api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function payment(PaymentRequest $request) 
    { 
        $input = $request->all(); 

        $LoanObj = Loan::find($input['loan_id']);

        if($LoanObj->status ==1){

            $balance  = $LoanObj->balance_amount - $input['amount_paid'];

            if($balance > 0){
                $LoanObj->balance_amount = $balance;
                $LoanObj->save();

                $input['paid_on'] = Carbon::now();
                $payment = Payment::create($input); 
                return response()->json(['success'=>new PaymentResource($payment)], $this->successStatus); 
            }
            else if($balance ==0){
                $LoanObj->balance_amount = $balance;
                $LoanObj->status = 2;
                $LoanObj->save();

                $input['paid_on'] = Carbon::now();
                $payment = Payment::create($input); 
                return response()->json(['success'=>new PaymentResource($payment)], $this->successStatus); 
            }
            else{

                return response()->json(['message'=>'Balance amount is less'], $this->errorStatus); 
            }
        }
        else {

            return response()->json(['message'=>'Loan already closed'], $this->errorStatus); 

        }




        
    }
    
}
