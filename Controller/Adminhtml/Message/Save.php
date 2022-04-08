<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Controller\Adminhtml\Message;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use EVGV\GuestBook\Api\MessageRepositoryInterface;
use EVGV\GuestBook\Api\Data\MessageInterfaceFactory;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var DataPersistorInterface
     */
    private DataPersistorInterface $dataPersistor;

    /**
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;

    /**
     * @var MessageInterfaceFactory
     */
    private MessageInterfaceFactory $messageInterfaceFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        MessageRepositoryInterface $messageRepository,
        MessageInterfaceFactory $messageInterfaceFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->messageRepository = $messageRepository;
        $this->messageInterfaceFactory = $messageInterfaceFactory;

        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {

            $id = (int) $this->getRequest()->getParam('message_id');
            if ($id) {
                try {
                    $model = $this->messageRepository->get($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This message no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                $data['message_id'] = null;
                $model = $this->messageInterfaceFactory->create();
            }

            $model->setData($data);

            try {
                $this->messageRepository->save($model);

                $this->messageManager->addSuccessMessage(__('You saved the Message.'));
                $this->dataPersistor->clear('evgv_guestbook_message');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['message_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Message.'));
            }

            $this->dataPersistor->set('evgv_guestbook_message', $data);
            return $resultRedirect->setPath('*/*/edit', ['message_id' => $this->getRequest()->getParam('message_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

