<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Controller\Adminhtml\Message;

use EVGV\GuestBook\Api\MessageRepositoryInterface;
use EVGV\GuestBook\Model\Status;
use EVGV\GuestBook\Api\Data\MessageInterface;
use Magento\Framework\Exception\LocalizedException;

class Approve extends \EVGV\GuestBook\Controller\Adminhtml\Message
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

        $id = $this->getRequest()->getParam('message_id');
        if ($id) {
            try {
                $model = $this->messageRepository->get($id);
                $model->setData(MessageInterface::STATUS, Status::STATUS_APPROVED);

                $this->messageRepository->save($model);

                $this->messageManager->addSuccessMessage(__('You approved the Message.'));

                return $resultRedirect->setPath('*/*/');

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a message to approve.'));

        return $resultRedirect->setPath('*/*/');
    }
}

