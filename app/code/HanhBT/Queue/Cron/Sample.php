<?php

namespace HanhBT\Queue\Cron;

use Psr\Log\LoggerInterface;

class Sample
{
    private $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->log('debug', date('H:i d/m/Y'));
    }
}
