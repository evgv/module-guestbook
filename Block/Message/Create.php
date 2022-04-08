<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Block\Message;

class Create extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Returns action url
     *
     * @return string
     */
    public function getFormAction()
    {
        return str_replace('app.', '', $this->getUrl('guestbook/message/create', ['_secure' => true]));
//        return $this->getUrl('guestbook/message/create', ['_secure' => true]); // add after test to avoid redirect to react app
    }
}

