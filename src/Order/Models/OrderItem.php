<?php

namespace Soda\Ecommerce\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Soda\Ecommerce\Order\Interfaces\OrderInterface;
use Soda\Ecommerce\Order\Interfaces\OrderItemInterface;
use Soda\Ecommerce\Support\Traits\QuantifiableItemTrait;

class OrderItem extends Model implements OrderItemInterface
{
    use QuantifiableItemTrait;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'store_product_id',
        'quantity',
        'unit_price',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(resolve_class(OrderInterface::class));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storeProduct()
    {
        return $this->belongsTo(resolve_class(StoreProductInterface::class))->withTrashed();
    }
}
