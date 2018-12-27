<?php

namespace Veriteworks\ParetoAnalytics\Api\Data;

/**
 * Interface GridInterface
 * @package Veriteworks\ParetoAnalytics\Api\Data
 */
interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const GRAND_TOTAL = 'grand_total';
    /**
     *
     */
    const CUSTOMER_NAME = 'customer_name';

    /**
     *
     */
    const CUSTOMER_ID = 'customer_id';

    /**
     * @return mixed
     */
    public function getGrandTotal();

    /**
     * @return mixed
     */
    public function getCustomerId();

    public function getCustomerName();

    /**
     * @param $amount
     * @return mixed
     */
    public function setGrandTotal($amount);

    /**
     * @param $id
     * @return mixed
     */
    public function setCustomerId($id);

    public function setCustomerName($name);




}