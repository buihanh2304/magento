<?php

namespace HanhBT\Event\ViewModel;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class UserDataProvider implements ArgumentInterface
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var array
     */
    private $postData = null;

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getPostValue('title');
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getPostValue('description');
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->getPostValue('address');
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->getPostValue('time');
    }

    private function getPostValue($key, $default = '')
    {
        if (null === $this->postData) {
            $this->postData = (array) $this->getDataPersistor()->get('event');
            $this->getDataPersistor()->clear('event');
        }

        if (isset($this->postData[$key])) {
            return (string) $this->postData[$key];
        }

        return $default;
    }

    /**
     * Get Data Persistor
     *
     * @return DataPersistorInterface
     */
    private function getDataPersistor()
    {
        if ($this->dataPersistor === null) {
            $this->dataPersistor = ObjectManager::getInstance()
                ->get(DataPersistorInterface::class);
        }

        return $this->dataPersistor;
    }
}
