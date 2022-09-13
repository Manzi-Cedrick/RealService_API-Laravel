<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'ProductName','ProductPrice','ProductQRCode','Quantity','Description','StockID'
    ];
    public function Client(){
        return $this->hasMany(Client::class,'ProductID');
    }
    public function Stock_Product(){
        return $this->belongsTo(Stock::class,'StockID');
    }
}
