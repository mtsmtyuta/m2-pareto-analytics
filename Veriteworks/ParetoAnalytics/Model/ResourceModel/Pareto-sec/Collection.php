<?php
namespace Veriteworks\ParetoAnalytics\Model\ResourceModel\Pareto;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use \Magento\Framework\Api\SearchCriteriaInterface;

class Collection extends AbstractCollection
{

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            'Veriteworks\ParetoAnalytics\Model\ParetoSec',
            'Veriteworks\ParetoAnalytics\Model\ResourceModel\ParetoSec'
        );
    }

}