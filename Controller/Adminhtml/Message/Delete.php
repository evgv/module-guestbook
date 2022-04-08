<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Controller\Adminhtml\Message;

use EVGV\GuestBook\Api\MessageRepositoryInterface;

class Delete extends \EVGV\GuestBook\Controller\Adminhtml\Message
{
    /**
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        MessageRepositoryInterface $messageRepository
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->messageRepository = $messageRepository;

        parent::__construct($context, $coreRegistry);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('message_id');
        if ($id) {
            try {
                $model = $this->messageRepository->get($id);
                $this->messageRepository->delete($model);
                $this->messageManager->addSuccessMessage(__('You deleted the Message.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['message_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a Message to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}

