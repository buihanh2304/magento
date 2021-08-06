<?php

namespace HanhBT\Event\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Index extends Template
{
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);

        $this->_isScopePrivate = true;
    }

    public function getFormAction()
    {
        return $this->getUrl('event/index/post', ['_secure' => true]);
    }
}
