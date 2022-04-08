<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Api\Data;

interface MessageInterface
{

    const EMAIL = 'email';
    const MESSAGE = 'message';
    const STATUS = 'status';
    const NAME = 'name';
    const POSTED_AT = 'posted_at';
    const MESSAGE_ID = 'message_id';

    /**
     * Get message_id
     * @return string|null
     */
    public function getMessageId();

    /**
     * Set message_id
     * @param string $messageId
     * @return \EVGV\GuestBook\Message\Api\Data\MessageInterface
     */
    public function setMessageId($messageId);

    /**
     * Get posted_at
     * @return string|null
     */
    public function getPostedAt();

    /**
     * Set posted_at
     * @param string $postedAt
     * @return \EVGV\GuestBook\Message\Api\Data\MessageInterface
     */
    public function setPostedAt($postedAt);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \EVGV\GuestBook\Message\Api\Data\MessageInterface
     */
    public function setName($name);

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \EVGV\GuestBook\Message\Api\Data\MessageInterface
     */
    public function setEmail($email);

    /**
     * Get message
     * @return string|null
     */
    public function getMessage();

    /**
     * Set message
     * @param string $message
     * @return \EVGV\GuestBook\Message\Api\Data\MessageInterface
     */
    public function setMessage($message);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \EVGV\GuestBook\Message\Api\Data\MessageInterface
     */
    public function setStatus($status);
}

