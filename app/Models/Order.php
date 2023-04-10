<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }

    public function inventory_orders()
    {
        return $this->hasMany(InventoryOrder::class);
    }

    public function shipping(){
        return $this->hasOne(ShippingInfo::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
