<?php

namespace Soda\Ecommerce\Customer\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Soda\Cms\Models\Traits\PermissionsRoleTrait;
use Soda\Ecommerce\Customer\Interfaces\CustomerAddressInterface;
use Soda\Ecommerce\Customer\Interfaces\CustomerInterface;
use Soda\Ecommerce\Order\Interfaces\OrderInterface;
use Soda\Ecommerce\Store\Interfaces\StoreInterface;

class Customer extends Authenticatable implements CustomerInterface
{
    use PermissionsRoleTrait, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'store_id',
        'default_shipping_address_id',
        'default_billing_address_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(resolve_class(StoreInterface::class));
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
    public function addresses()
    {
        return $this->hasMany(resolve_class(CustomerAddressInterface::class));
    }
}
