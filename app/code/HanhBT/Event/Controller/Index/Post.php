<?php

namespace HanhBT\Event\Controller\Index;

use HanhBT\Event\Model\Resource\Event;
use HanhBT\Event\Model\EventFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;


class Post extends Action implements HttpPostActionInterface
{
    private $dataPersistor;

    private $logger;

    private $eventFactory;

    private $eventRepository;

    /**
     * @var \Magento\Framework\App\HttpRequestInterface $request
     */
    private $request;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        EventFactory $eventFactory,
        Event $eventRepository,
        DataPersistorInterface $dataPersistor,
        LoggerInterface $logger = null
    ) {
        parent::__construct($context);

        $this->eventFactory = $eventFactory;
        $this->eventRepository = $eventRepository;
        $this->dataPersistor = $dataPersistor;
        $this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
        $this->request = $this->getRequest();
    }

    /**
     * Post user question
     *
     * @return Redirect
     */
    public function execute()
    {
        if (! $this->request->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        try {
            $this->saveEvent($this->validatedParams());
            $this->messageManager->addSuccessMessage(
                __('Create event successfully!')
            );
            $this->dataPersistor->clear('event');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('event', $this->getRequest()->getParams());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            $this->dataPersistor->set('event', $this->getRequest()->getParams());
        }

        return $this->resultRedirectFactory->create()->setPath('event/index');
    }

    /**
     * @param array $event Event data
     * @return void
     */
    private function saveEvent($event)
    {
        $model = $this->eventFactory->create();
        $model->setData($event);

        return $this->eventRepository->save($model);
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function validatedParams()
    {
        $request = $this->getRequest();

        if (trim($request->getParam('title')) === '') {
            throw new LocalizedException(__('Enter the Title and try again.'));
        }

        if (trim($request->getParam('description')) === '') {
            throw new LocalizedException(__('Enter the description and try again.'));
        }

        if (trim($request->getParam('address')) === '') {
            throw new LocalizedException(__('Enter the address and try again.'));
        }

        if (trim($request->getParam('time')) === '') {
            throw new LocalizedException(__('Enter the time and try again.'));
        }

        return $request->getParams();
    }
}
