<?php

namespace HanhBT\Queue\Cron;

use Psr\Log\LoggerInterface;

class OtherSample
{
    private $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->log('debug', date('H:i:s d/m/Y'));
    }
}
