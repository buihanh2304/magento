<?php

namespace HanhBT\Donate\Model\Creditmemo\Total;

use Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal;

class Donate extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Creditmemo $creditmemo
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Creditmemo $creditmemo)
    {
        $creditmemo->setDonate(0);
        $creditmemo->setBaseDonate(0);

        $amount = $creditmemo->getOrder()->getDonate();
        $creditmemo->setDonate($amount);

        $amount = $creditmemo->getOrder()->getBaseDonate();
        $creditmemo->setBaseDonate($amount);

        $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $creditmemo->getDonate());
        $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $creditmemo->getBaseDonate());

        return $this;
    }
}
