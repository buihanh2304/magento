<?php

namespace HanhBT\HelloWorld\Block\Event;

use HanhBT\Event\Block\Index as EventIndex;
use Magento\Framework\View\Element\Template\Context;
use Psr\Log\LoggerInterface;

class Index extends EventIndex
{
    private $logger;

    public function __construct(
        LoggerInterface $logger,
        Context $context,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $data
        );

        $this->logger = $logger;
    }

    public function getFormAction()
    {
        $this->logger->debug('Overwrite method!');

        return parent::getFormAction();
    }
}
