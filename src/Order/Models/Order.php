<?php

namespace Soda\Ecommerce\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Soda\Ecommerce\Order\Observers\OrderObserver;
use Soda\Ecommerce\Order\Interfaces\OrderInterface;
use Soda\Ecommerce\Order\Interfaces\OrderItemInterface;
use Soda\Ecommerce\Customer\Interfaces\CustomerInterface;
use Soda\Ecommerce\Foundation\Exceptions\InvalidOrderException;

class Order extends Model implements OrderInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'store_id',
        'shipping_method_id',
        'shipping_address_id',
        'billing_address_id',
        'total',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        static::observe(OrderObserver::class);

        parent::boot();
    }

    /**
     * {@inheritdoc}
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->hasOne(resolve_class(CustomerInterface::class));
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
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @throws InvalidOrderException
     */
    public function fillFromCart()
    {
        $cart = app('soda.ecommerce.cart');

        $items = $cart->getItems();

        if (! count($items)) {
            throw new InvalidOrderException('There are no items in your cart.');
        }

        foreach ($items as $item) {
            $this->items()->create([
                'store_product_id' => $item->getProductId(),
                'quantity'         => $item->getQuantity(),
                'unit_price'       => $item->getUnitPrice(),
            ]);

            // Delete the record without throwing the delete event
            $item->where('id', $item->id)->delete();
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(resolve_class(OrderItemInterface::class));
    }
}
