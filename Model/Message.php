<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Model;

use EVGV\GuestBook\Api\Data\MessageInterface;
use Magento\Framework\Model\AbstractModel;

class Message extends AbstractModel implements MessageInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\EVGV\GuestBook\Model\ResourceModel\Message::class);
    }

    /**
     * @inheritDoc
     */
    public function getMessageId()
    {
        return $this->getData(self::MESSAGE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setMessageId($messageId)
    {
        return $this->setData(self::MESSAGE_ID, $messageId);
    }

    /**
     * @inheritDoc
     */
    public function getPostedAt()
    {
        return $this->getData(self::POSTED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setPostedAt($postedAt)
    {
        return $this->setData(self::POSTED_AT, $postedAt);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * @inheritDoc
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}

