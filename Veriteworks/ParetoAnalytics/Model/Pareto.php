<?php

namespace Veriteworks\ParetoAnalytics\Model;

use Veriteworks\ParetoAnalytics\Api\Data\GridInterface;
use \Magento\Framework\Model\AbstractModel;

/**
 * Class Pareto
 * @package Veriteworks\ParetoAnalytics\Model
 */
class Pareto extends AbstractModel implements GridInterface
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Veriteworks\ParetoAnalytics\Model\ResourceModel\Pareto');
    }

    /**
     * @return mixed
     */
    public function getGrandTotal()
    {
        $this->getData(OrderInterface::GRAND_TOTAL);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        $this->getData(OrderInterface::CUSTOMER_ID);
        return $this;
    }

    /**
     * @param $amount
     * @return Pareto
     */
    public function setGrandTotal($amount)
    {
        $this->setData(OrderInterface::GRAND_TOTAL, $amount);
        return $this;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function setCustomerId($id)
    {
        $this->setData(OrderInterface::CUSTOMER_ID, $id);
        return $this;
    }
}