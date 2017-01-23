<?php
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 1/23/17
 * Time: 5:23 PM
 */

namespace Rostiknaz\NovaPoshta\Api;


interface ClientInterface
{
    const DELIVERY_TYPE_APARTMENT_APARTMENT = 1;

    const DELIVERY_TYPE_APARTMENT_WAREHOUSE = 2;

    const DELIVERY_TYPE_WAREHOUSE_APARTMENT = 3;

    const DELIVERY_TYPE_WAREHOUSE_WAREHOUSE = 4;

    const LOAD_TYPE_STANDARD   = 1;

    const LOAD_TYPE_SECURITIES = 4;

    public function request();
}