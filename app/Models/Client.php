<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'Firstname',
        'Lastname',
        'Cash_Paid_Frw',
        'Status_Payment',
        'Quantity_Paid_For',
        'Description_Work',
    ];

    public function Product(){
        return $this->belongsTo('App\Models\Product');
    }
}
