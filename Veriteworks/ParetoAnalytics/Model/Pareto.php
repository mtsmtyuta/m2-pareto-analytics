<?php
namespace Veriteworks\ParetoAnalytics\Model;

use Veriteworks\ParetoAnalytics\Api\Data\GridInterface;
use \Magento\Framework\Model\AbstractModel;

class Pareto extends AbstractModel implements GridInterface
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Veriteworks\ParetoAnalytics\Model\ResourceModel\Pareto');
    }

    public function getGrandTotal()
    {
        return $this->getData(OrderInterface::GRAND_TOTAL);
    }

    public function setGrandTotal($amount)
    {
        return $this->setData(OrderInterface::GRAND_TOTAL, $amount);
    }
}