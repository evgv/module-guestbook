<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Controller\Adminhtml;

abstract class Message extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'EVGV_GuestBook::top_level';

    protected $_coreRegistry;

    /**
     * @todo add message rep and remove construct method from the edit and delete action to go along DRY pattern
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('EVGV'), __('EVGV'))
            ->addBreadcrumb(__('Message'), __('Message'));
        return $resultPage;
    }
}

