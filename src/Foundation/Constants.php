<?php

namespace Soda\Ecommerce\Foundation;

class Constants
{
    const ORDER_STATUS_NEW = 'new';
    const ORDER_STATUS_PROCESSING = 'processing';
    const ORDER_STATUS_BACKORDERED = 'backordered';
    const ORDER_STATUS_PARTIALLY_SHIPPED = 'partially_shipped';
    const ORDER_STATUS_SHIPPED = 'shipped';
    const ORDER_STATUS_COMPLETED = 'completed';
    const ORDER_STATUS_CANCELLED = 'cancelled';

    const ADDRESS_TYPE_SHIPPING = 'shipping';
    const ADDRESS_TYPE_BILLING = 'billing';

    const SHIPPING_TYPE_PICKUP = 'pickup';
    const SHIPPING_TYPE_DELIVERY = 'delivery';

    const PRODUCT_STATUS_ENABLED = 1;
    const PRODUCT_STATUS_DISABLED = 0;

    const VISITOR_TYPE_GUEST = 'guest';
    const VISITOR_TYPE_REGISTERED = 'customer';
}
