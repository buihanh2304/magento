<?php

namespace HanhBT\Queue\Controller\Index;

use Exception;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\MysqlMq\Model\QueueManagement;

class Index extends Action
{
    const TOPIC_NAME = 'hanhbt.queue.topic';

    private $publisher;
    private $json;

    public function __construct(
        Context $context,
        PublisherInterface $publisher,
        Json $json
    ) {
        parent::__construct($context);

        $this->publisher = $publisher;
        $this->json = $json;
    }

    public function execute()
    {
        try {
            $data = [23, 4, 94];
            $this->publisher->publish(self::TOPIC_NAME, $this->json->serialize($data));

            echo __('Message is added to queue!');
        } catch (Exception $exception) {
            echo __($exception);
        }

    }
}
