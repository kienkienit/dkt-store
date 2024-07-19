<?php

namespace App\Enums;

enum OrderStatus: string
{
    case ALL = "all";
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
}
