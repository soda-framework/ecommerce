<?php

namespace Soda\Ecommerce\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Soda\Ecommerce\Customer\Interfaces\CustomerAddressInterface;
use Soda\Ecommerce\Customer\Interfaces\CustomerInterface;

class CustomerAddress extends Model implements CustomerAddressInterface
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'address_1',
        'address_2',
        'state',
        'postcode',
        'country',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->hasOne(resolve_class(CustomerInterface::class));
    }
}
