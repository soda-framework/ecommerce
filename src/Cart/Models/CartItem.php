<?php

namespace Soda\Ecommerce\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Soda\Ecommerce\Cart\Observers\CartItemObserver;
use Soda\Ecommerce\Cart\Interfaces\CartItemInterface;
use Soda\Ecommerce\Support\Traits\QuantifiableItemTrait;
use Soda\Ecommerce\Product\Interfaces\StoreProductInterface;

class CartItem extends Model implements CartItemInterface
{
    use QuantifiableItemTrait;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * Temporary flag to indicate that the associated product has been discontinued.
     *
     * @var bool
     */
    public $discontinued = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_product_id',
        'store_id',
        'visitor_id',
        'visitor_type',
        'quantity',
        'unit_price',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        static::observe(CartItemObserver::class);

        parent::boot();
    }

    /**
     * {@inheritdoc}
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(resolve_class(StoreInterface::class));
    }

    /**
     * {@inheritdoc}
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storeProduct()
    {
        return $this->belongsTo(resolve_class(StoreProductInterface::class));
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->store_product_id;
    }
}
