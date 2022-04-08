<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Controller\Message;

use EVGV\GuestBook\Api\MessageRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Create extends Action implements HttpPostActionInterface
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
        MessageRepositoryInterface $messageRepository
    ) {
        $this->messageRepository = $messageRepository;

        parent::__construct($context);
    }
    /**
     * Execute view action
     *
     * @todo add logger
     * @todo add data persistor
     *
     * @todo cannot test because of env configuration
     *
     * @return ResultInterface
     */
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        try {
            $data = $this->getRequest()->getPostValue();

            $model = $this->messageInterfaceFactory->create();
            $model->setData($data);

            $this->messageRepository->save($model);

            $this->messageManager->addSuccessMessage(
                __('Thanks for sending the message. It will be available after the moderation.')
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
        }

        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}

