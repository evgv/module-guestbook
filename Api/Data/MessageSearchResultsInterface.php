<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Api\Data;

interface MessageSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Message list.
     * @return \EVGV\GuestBook\Api\Data\MessageInterface[]
     */
    public function getItems();

    /**
     * Set posted_at list.
     * @param \EVGV\GuestBook\Api\Data\MessageInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

