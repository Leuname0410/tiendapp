<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class brand extends Model
{
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['name',];
    use SoftDeletes;

    /**
    * Get products by brand
    */
    public function products()
    {
        return $this->hasMany(product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($brand) {
            $brand->products()->delete();
        });
    }

}
