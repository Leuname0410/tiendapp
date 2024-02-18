<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'brand_id',
        'product_name',
        'size',
        'inventory_quantity',
        'shipment_date',
        'observations',
    ];

    use SoftDeletes;

    /**
    * Get brand of product
    */
    public function brand()
    {
        return $this->belongsTo(brand::class);
    }
}
