<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'brand_id',
        'product_name',
        'size',
        'inventory_quantity',
        'shipment_date',
        'observations',
        ];

    /**
    * Get brand of product
    */
    public function brand()
    {
        return $this->belongsTo(brand::class);
    }
}
