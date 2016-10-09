<?php

namespace Soda\Ecommerce\Store\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Soda\Ecommerce\Cart\Interfaces\CartItemInterface;
use Soda\Ecommerce\Customer\Interfaces\CustomerInterface;
use Soda\Ecommerce\Order\Interfaces\OrderInterface;
use Soda\Ecommerce\Product\Interfaces\ProductInterface;
use Soda\Ecommerce\Store\Interfaces\StoreInterface;

class Store extends Model implements StoreInterface
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'application_id',
        'address_1',
        'address_2',
        'state',
        'postcode',
        'country',
        'phone',
        'status',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(resolve_class(ProductInterface::class));
    }

    /**
     * {@inheritDoc}
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany(resolve_class(CustomerInterface::class));
    }

    /**
     * {@inheritDoc}
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(resolve_class(OrderInterface::class));
    }

    /**
     * {@inheritDoc}
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartedProdcuts()
    {
        return $this->hasMany(resolve_class(CartItemInterface::class));
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
}
