<?php

namespace HanhBT\Event\Controller\Adminhtml\Event;

use HanhBT\Event\Model\Event;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Delete extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'HanhBT_Event::delete';

    public function execute()
    {
        $id = $this->getRequest()->getParam('event_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            $title = "";
            try {
                // init model and delete
                $model = $this->_objectManager->create(Event::class);
                $model->load($id);

                $title = $model->getTitle();
                $model->delete();

                // display success message
                $this->messageManager->addSuccessMessage(__('The event has been deleted.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['event_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a event to delete.'));

        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
