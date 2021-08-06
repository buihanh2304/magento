<?php

namespace HanhBT\Event\Controller\Adminhtml\Event;

use HanhBT\Event\Model\Resource\Event;
use HanhBT\Event\Model\EventFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface
{
    protected $dataPersistor;

    private $eventFactory;

    private $eventRepository;

    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        Event $eventRepository,
        EventFactory $eventFactory = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->eventRepository = $eventRepository;
        $this->eventFactory = $eventFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(EventFactory::class);
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        /**
         * @var \Magento\Framework\App\Request\Http $request
         */
        $request = $this->getRequest();
        $data = $request->getPostValue();

        if ($data) {
            if (empty($data['event_id'])) {
                $data['event_id'] = null;
            }

            /** @var \HanhBT\Event\Model\Event $model */
            $model = $this->eventFactory->create();

            $id = $this->getRequest()->getParam('event_id');

            if ($id) {
                try {
                    $model = $model->load($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This event no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->eventRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the event.'));
                $this->dataPersistor->clear('event');
                return $this->processEventReturn($model, $data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the event.'));
            }

            $this->dataPersistor->set('event', $data);

            return $resultRedirect->setPath('*/*/edit', ['event_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    private function processEventReturn($model, $data, $resultRedirect)
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect === 'continue') {
            $resultRedirect->setPath('*/*/edit', ['event_id' => $model->getId()]);
        } else if ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        } else if ($redirect === 'duplicate') {
            $duplicateModel = $this->eventFactory->create(['data' => $data]);
            $duplicateModel->setId(null);
            $this->eventRepository->save($duplicateModel);
            $id = $duplicateModel->getId();
            $this->messageManager->addSuccessMessage(__('You duplicated the event.'));
            $this->dataPersistor->set('event', $data);
            $resultRedirect->setPath('*/*/edit', ['event_id' => $id]);
        }

        return $resultRedirect;
    }
}
