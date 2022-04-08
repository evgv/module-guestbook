<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Model\ResourceModel\Message;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'message_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \EVGV\GuestBook\Model\Message::class,
            \EVGV\GuestBook\Model\ResourceModel\Message::class
        );
    }
}

