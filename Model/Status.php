<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Model;

use EVGV\GuestBook\Api\Data\MessageInterface;
use Magento\Framework\Model\AbstractModel;

class Status
{
    public const STATUS_PENDING = 1;
    public const STATUS_APPROVED = 2;
    public const STATUS_DECLINED = 3;

    public const STATUS_PENDING_LABEL = 'pending';
    public const STATUS_APPROVED_LABEL = 'approved';
    public const STATUS_DECLINED_LABEL = 'declined';

}

