<?php

namespace HanhBT\HelloWorld\Controller\Index;

use HanhBT\HelloWorld\Language\LanguageInterface;
use HanhBT\HelloWorld\API\DressInterface;
use HanhBT\HelloWorld\Model\Dress;
use HanhBT\HelloWorld\Model\Short;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface
{
    private $pageFactory;

    private $language;

    private $dress;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        LanguageInterface $language,
        DressInterface $dress
    ) {
        parent::__construct($context);

        $this->pageFactory = $pageFactory;
        $this->language = $language;
        $this->dress = $dress;
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        echo $this->language->getText();
        echo '<br/>';
        echo $this->dress->getDressType();
        $objectManager = ObjectManager::getInstance();
        $dress = $objectManager->create(Dress::class);
        $short = $objectManager->create(Short::class);
        echo '<pre>';
        \var_dump($dress, $short);
        echo '</pre>';
    }
}
