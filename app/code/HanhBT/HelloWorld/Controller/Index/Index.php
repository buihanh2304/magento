<?php

namespace HanhBT\HelloWorld\Controller\Index;

use HanhBT\HelloWorld\Language\LanguageInterface;
use HanhBT\HelloWorld\API\DressInterface;
use HanhBT\HelloWorld\Model\Dress;
use HanhBT\HelloWorld\Model\Pants;
use HanhBT\HelloWorld\Model\Shorts;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface
{
    private $pageFactory;

    private $language;

    private $dress;
    private $dress2;
    private $dress3;
    private $dress4;
    private $shorts;
    private $pants;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        LanguageInterface $language,
        DressInterface $dress,
        DressInterface $dress2,
        Dress $dress3,
        Dress $dress4,
        Shorts $shorts,
        Pants $pants
    ) {
        parent::__construct($context);

        $this->pageFactory = $pageFactory;
        $this->language = $language;
        $this->dress = $dress;
        $this->dress2 = $dress2;
        $this->dress3 = $dress3;
        $this->dress4 = $dress4;
        $this->shorts = $shorts;
        $this->pants = $pants;
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

        $this->dress->setName('Dress 1');

        echo $this->dress->getType();
        echo '<br/>';

        echo $this->dress2->getType();
        echo '<br/>';

        $this->dress3->setName('Dress 3');

        echo $this->dress3->getType();
        echo '<br/>';

        echo $this->dress4->getType();
        echo '<br/>';

        echo $this->shorts->getType();
        echo '<br/>';

        echo $this->pants->getType();
        echo '<br/>';
    }
}
