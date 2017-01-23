<?php
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 1/23/17
 * Time: 4:33 PM
 */

namespace Rostiknaz\NovaPoshta\Model\ResourceModel\City;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Rostiknaz\NovaPoshta\Model\Warehouse', 'Rostiknaz\NovaPoshta\Model\ResourceModel\Warehouse');
    }
}