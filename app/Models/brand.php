<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['name',];

    /**
    * Get products by brand
    */
    public function products()
    {
        return $this->hasMany(product::class);
    }

}
