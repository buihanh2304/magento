<?php

namespace HanhBT\Event\Controller\Adminhtml\Event;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;

class NewAction extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'HanhBT_Event::save';

    protected $forwardFactory;

    public function __construct(
        Context $context,
        ForwardFactory $forwardFactory
    ) {
        parent::__construct($context);

        $this->forwardFactory = $forwardFactory;
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Forward $forward */
        $forward = $this->forwardFactory->create();

        return $forward->forward('edit');
    }
}
