<?php

namespace Soda\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Soda\Ecommerce\Product\Interfaces\ProductInterface;
use Soda\Ecommerce\Product\Interfaces\StoreProductInterface;

class Product extends Model implements ProductInterface
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'description',
        'brand_name',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * {@inheritDoc}
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function storeProducts()
    {
        return $this->hasMany(resolve_class(StoreProductInterface::class));
    }
}
