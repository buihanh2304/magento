<?php

namespace HanhBT\Event\Model\Resource\Event;

use HanhBT\Event\Model\Event;
use HanhBT\Event\Model\Resource\Event as ResourceEvent;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'event_id';
    protected $_eventPrefix = 'hanhbt_event_collection';
    protected $_eventObject = 'event_collection';

    protected function _construct()
    {
        $this->_init(Event::class, ResourceEvent::class);
    }
}
