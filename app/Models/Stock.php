<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'Stock_Name','Stock_Quantity','Registration_Date','Expiration_Date'
    ];
    //Stock to Product Relation
    public function Products_Stock(){
        return $this->hasMany(Product::class,'StockID');
    }
}
