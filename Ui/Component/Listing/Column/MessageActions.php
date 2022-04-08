<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Ui\Component\Listing\Column;

class MessageActions extends \Magento\Ui\Component\Listing\Columns\Column
{

    const URL_PATH_APPROVE = 'evgv_guestbook/message/approve';
    const URL_PATH_DISAPPROVE = 'evgv_guestbook/message/disapprove';
//    const URL_PATH_DETAILS = 'evgv_guestbook/message/details';
    const URL_PATH_EDIT = 'evgv_guestbook/message/edit';
    const URL_PATH_DELETE = 'evgv_guestbook/message/delete';

    protected $urlBuilder;

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['message_id'])) {
                    $item[$this->getData('name')] = [
                        'approve' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_APPROVE,
                                [
                                    'message_id' => $item['message_id']
                                ]
                            ),
                            'label' => __('Approve')
                        ],
                        'disapprove' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DISAPPROVE,
                                [
                                    'message_id' => $item['message_id']
                                ]
                            ),
                            'label' => __('Disapprove')
                        ],
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'message_id' => $item['message_id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'message_id' => $item['message_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete "${ $.$data.title }"'),
                                'message' => __('Are you sure you wan\'t to delete a "${ $.$data.title }" record?')
                            ]
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}

