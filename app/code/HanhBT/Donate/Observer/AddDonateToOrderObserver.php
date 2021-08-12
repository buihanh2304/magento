<?php
namespace HanhBT\Donate\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddDonateToOrderObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $quote = $observer->getQuote();
        $donate = $quote->getDonate();
        $baseDonate = $quote->getBaseDonate();

        if (!$donate || !$baseDonate) {
            return $this;
        }

        //Set donate data to order
        $order = $observer->getOrder();
        $order->setData('donate', $donate);
        $order->setData('base_donate', $baseDonate);

        return $this;
    }
}
