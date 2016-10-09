<?php

namespace Soda\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Soda\Ecommerce\Product\Interfaces\ProductInterface;
use Soda\Ecommerce\Product\Interfaces\StoreProductInterface;
use Soda\Ecommerce\Product\Observers\StoreProductObserver;
use Soda\Ecommerce\Store\Interfaces\StoreInterface;

class StoreProduct extends Model implements StoreProductInterface
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'store_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'store_id',
        'status',
        'price',
        'sale_price',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        static::observe(StoreProductObserver::class);

        parent::boot();
    }

    /**
     * {@inheritDoc}
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(resolve_class(ProductInterface::class));
    }

    /**
     * {@inheritDoc}
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(resolve_class(StoreInterface::class));
    }

    /**
     * {@inheritDoc}
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->sale_price === null ? $this->sale_price : $this->price;
    }
}
