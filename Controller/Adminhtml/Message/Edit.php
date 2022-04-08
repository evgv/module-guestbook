<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Controller\Adminhtml\Message;

use EVGV\GuestBook\Api\MessageRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends \EVGV\GuestBook\Controller\Adminhtml\Message
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected \Magento\Framework\View\Result\PageFactory $resultPageFactory;

    /**
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        MessageRepositoryInterface $messageRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->messageRepository = $messageRepository;

        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = (int) $this->getRequest()->getParam('message_id');

        if ($id) {
            try {
                $model = $this->messageRepository->get($id);
                $this->_coreRegistry->register('evgv_guestbook_message', $model);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This message no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Message') : __('New Message'),
            $id ? __('Edit Message') : __('New Message')
        );

        $resultPage->getConfig()->getTitle()->prepend(__('Messages'));
        $resultPage->getConfig()->getTitle()->prepend($id ? __('Edit Message %1', $id) : __('New Message'));

        return $resultPage;
    }
}

