<?php
namespace HanhBT\Donate\Plugin\Checkout\Model;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Model\Session;
use Magento\Checkout\Model\ShippingInformationManagement as ModelShippingInformationManagement;
use Magento\Framework\Exception\InputException;
use Magento\Quote\Model\QuoteRepository;

class ShippingInformationManagement
{
    protected $session;

    protected $quoteRepository;

    /**
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     */
    public function __construct(
        QuoteRepository $quoteRepository,
        Session $session
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->session = $session;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        ModelShippingInformationManagement $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    )
    {
        $donate = $addressInformation->getExtensionAttributes()->getDonate();

        if ((!is_int($donate) && !is_float($donate)) || $donate < 0) {
            throw new InputException(__('Donate amount must be positive number!'));
        }

        $quote = $this->quoteRepository->getActive($cartId);

        $quote->setDonate($donate);
    }
}

