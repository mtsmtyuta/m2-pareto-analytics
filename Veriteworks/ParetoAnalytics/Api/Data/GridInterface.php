<?php

namespace Veriteworks\ParetoAnalytics\Api\Data;

interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const GRAND_TOTAL = 'grand_total';
    const CUSTOMER_ID = 'customer_id';

    public function getGrandTotal();

    public function getCustomerId();

    public function setGrandTotal($amount);

    public function setCustomerId($id);


}