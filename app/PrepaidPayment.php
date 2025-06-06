<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrepaidPayment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idpayment', 'prepaid_payment_type_id', 'paidamount', 'receiveddate', 'paiddate', 'instructionid',
    ];
}
