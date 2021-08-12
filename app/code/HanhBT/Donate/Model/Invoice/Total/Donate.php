<?php

namespace HanhBT\Donate\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;

class Donate extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Invoice $invoice)
    {
        $invoice->setDonate(0);
        $invoice->setBaseDonate(0);

        $amount = $invoice->getOrder()->getDonate();
        $invoice->setDonate($amount);
        $amount = $invoice->getOrder()->getBaseDonate();
        $invoice->setBaseDonate($amount);

        $invoice->setGrandTotal($invoice->getGrandTotal() + $invoice->getDonate());
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $invoice->getDonate());

        return $this;
    }
}
