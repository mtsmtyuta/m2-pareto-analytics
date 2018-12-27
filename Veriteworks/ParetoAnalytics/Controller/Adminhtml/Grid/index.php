<?php

namespace Veriteworks\ParetoAnalytics\Controller\Adminhtml\Grid;


/**
 * Class Index
 * @package Veriteworks\ParetoAnalytics\Controller\Adminhtml\Grid
 */
class Index extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    /**
     * Grid List page.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
//        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
//        $resultPage = $this->_resultPageFactory->create();
//        $resultPage->setActiveMenu('Veriteworks_ParetoAnalytics::grid');
//        $resultPage->getConfig()->getTitle()->prepend(__('Pareto Analytics'));
//
//        return $resultPage;

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('sales_order_grid'); //gives table name with prefix

        $query1 = "SELECT CEILING(COUNT(distinct customer_id)*0.2) as totals FROM magento.sales_order_grid";
        $result = $connection->fetchAll($query1);

        $query = "SELECT customer_id,customer_name, sum(grand_total) as customer_total from magento.sales_order_grid where created_at > (now() -interval 1 month) group by customer_id,customer_name order by sum(grand_total) desc limit ".$result[0]['totals']."";
        $result1 = $connection->fetchAll($query);

        $arrayValues = "";

        foreach($result1 as $results){
            $id = $results['customer_id'];
            $name = $results['customer_name'];
            $total = $results['customer_total'];
            $arrayValues[] = "({$id},'{$name}', {$total})";
        }

        $del_sql = "DROP TABLE sales_pareto";
        $connection->query($del_sql);
        $create_sql = "create table sales_pareto (customer_id int,customer_name varchar(255) ,grand_total float)DEFAULT CHARSET=utf8";
        $connection->query($create_sql);
        $sql = "INSERT INTO magento.sales_pareto (customer_id,customer_name, grand_total) VALUES ".join(",", $arrayValues);
        $connection->query($sql);

//        echo '<pre>';
//        print_r($sql);
//        echo '</pre>';


        // sales_pareto 3 month
        $query3 = "SELECT customer_id,customer_name, sum(grand_total) as customer_total from magento.sales_order_grid where created_at > (now() -interval 3 month) group by customer_id,customer_name order by sum(grand_total) desc limit ".$result[0]['totals']."";
        $result3 = $connection->fetchAll($query3);

        $arrayValues = "";

        foreach($result3 as $results3){
            $id = $results3['customer_id'];
            $name = $results3['customer_name'];
            $total = $results3['customer_total'];
            $arrayValues[] = "({$id},'{$name}', {$total})";
        }

        $del_sql3 = "DROP TABLE sales_pareto3";
        $connection->query($del_sql3);
        $create_sql3 = "create table sales_pareto3 (customer_id int,customer_name varchar(255) ,grand_total float)DEFAULT CHARSET=utf8";
        $connection->query($create_sql3);
        $sql3 = "INSERT INTO magento.sales_pareto3 (customer_id,customer_name, grand_total) VALUES ".join(",", $arrayValues);
        $connection->query($sql3);

//        echo '<pre>';
//        print_r($sql3);
//        echo '</pre>';


        // sales_pareto 6 month
        $query6 = "SELECT customer_id,customer_name, sum(grand_total) as customer_total from magento.sales_order_grid where created_at > (now() -interval 6 month) group by customer_id,customer_name order by sum(grand_total) desc limit ".$result[0]['totals']."";
        $result6 = $connection->fetchAll($query6);

        $arrayValues = "";

        foreach($result6 as $results6){
            $id = $results6['customer_id'];
            $name = $results6['customer_name'];
            $total = $results6['customer_total'];
            $arrayValues[] = "({$id},'{$name}', {$total})";
        }

        $del_sql6 = "DROP TABLE sales_pareto6";
        $connection->query($del_sql6);
        $create_sql6 = "create table sales_pareto6 (customer_id int,customer_name varchar(255) ,grand_total float)DEFAULT CHARSET=utf8";
        $connection->query($create_sql6);
        $sql6 = "INSERT INTO magento.sales_pareto6 (customer_id,customer_name, grand_total) VALUES ".join(",", $arrayValues);
        $connection->query($sql6);

//        echo '<pre>';
//        print_r($sql6);
//        echo '</pre>';

        //return $result;

    }

}