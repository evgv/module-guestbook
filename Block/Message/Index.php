<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace EVGV\GuestBook\Block\Message;

use EVGV\GuestBook\Api\Data\MessageInterface;
use EVGV\GuestBook\Api\MessageRepositoryInterface;
use EVGV\GuestBook\Model\Status;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;


class Index extends \Magento\Framework\View\Element\Template
{
    public const DATETIME_FORMAT = 'd-M-Y H:m:s';

    /**
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var SortOrderBuilder
     */
    private SortOrderBuilder $sortOrderBuilder;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        MessageRepositoryInterface $messageRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        $this->messageRepository = $messageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;

        parent::__construct($context, $data);
    }

    /**
     * @return \EVGV\GuestBook\Api\Data\MessageSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getMessages()
    {
        // filters
        $this->searchCriteriaBuilder->addFilter(MessageInterface::STATUS, Status::STATUS_APPROVED);

        // order
        $sortOrder = $this->sortOrderBuilder
            ->setField(MessageInterface::POSTED_AT)
            ->setDirection('DESC')
            ->create();

        $this->searchCriteriaBuilder->setSortOrders([$sortOrder]);

        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->messageRepository->getList($searchCriteria)->getItems();
    }

    /**
     * @param MessageInterface $message
     * @return string
     */
    public function getMessageInfo(MessageInterface $message): string
    {
        return sprintf(
            '%s - %s (%s)',
            date(self::DATETIME_FORMAT, strtotime($message->getPostedAt())),
            $message->getName(),
            $message->getEmail()
        );
    }
}

