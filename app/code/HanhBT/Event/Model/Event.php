<?php

namespace HanhBT\Event\Model;

use HanhBT\Event\Model\Resource\Event as ResourceEvent;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Event extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'hanhbt_event';

    protected $_cacheTag = 'hanhbt_event';

    protected $_eventPrefix = 'hanhbt_event';

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    protected function _construct()
    {
        $this->_init(ResourceEvent::class);
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
