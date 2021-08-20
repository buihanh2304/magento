<?php

namespace HanhBT\Queue\Model\Queue;

use Psr\Log\LoggerInterface;

class Consumer
{
    private $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }
    /**
     * @param $data
     */
    public function process($data)
    {
        $this->logger->log('debug', $data);

        return true;
    }
}
