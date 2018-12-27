<?php

namespace Veriteworks\ParetoAnalytics\Model;

use Veriteworks\ParetoAnalytics\Api\Data\GridInterface;
use \Magento\Framework\Model\AbstractModel;

/**
 * Class Pareto
 * @package Veriteworks\ParetoAnalytics\Model
 */
class ParetoSec extends AbstractModel implements GridInterface
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Veriteworks\ParetoAnalytics\Model\ResourceModel\ParetoSec');
    }
}