<?php

namespace HanhBT\Event\Controller\Adminhtml\Event;

use HanhBT\Event\Model\Event;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'HanhBT_Event::save';

    protected $pageFactory;

    private $registry;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Registry $registry
    ) {
        parent::__construct($context);

        $this->pageFactory = $pageFactory;
        $this->registry = $registry;
    }

    protected function _initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $page */
        $page = $this->pageFactory->create();
        $page->setActiveMenu('HanhBT_Event::event');

        return $page;
    }

    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('event_id');
        $model = $this->_objectManager->create(Event::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);

            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This event no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $redirect */
                $redirect = $this->resultRedirectFactory->create();

                return $redirect->setPath('*/*/');
            }
        }

        $this->registry->register('event', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $page */
        $page = $this->_initAction();
        $page->addBreadcrumb(
            $id ? __('Edit Event') : __('New Event'),
            $id ? __('Edit Event') : __('New Event')
        );
        $page->getConfig()->getTitle()->prepend(__('Events'));
        $page->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Event'));

        return $page;
    }
}
