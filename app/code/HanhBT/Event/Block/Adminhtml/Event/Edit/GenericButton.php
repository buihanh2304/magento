<?php

namespace HanhBT\Event\Block\Adminhtml\Event\Edit;

use HanhBT\Event\Model\EventFactory;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    protected $context;


    protected $eventFactory;

    public function __construct(
        Context $context,
        EventFactory $eventFactory
    ) {
        $this->context = $context;
        $this->eventFactory = $eventFactory;
    }

    public function getEventId()
    {
        try {
            $event = $this->eventFactory->create();

            return $event->load(
                $this->context->getRequest()->getParam('event_id')
            )->getId();
        } catch (NoSuchEntityException $e) {}

        return null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
